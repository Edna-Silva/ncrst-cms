import React, { useState } from 'react';
import { FileText, Clock, CheckCircle, AlertCircle, Edit, Trash2, Plus, Send, Eye } from 'lucide-react';
import { PendingChange } from '../../types';

const CheckerDashboard: React.FC = () => {
  const [pendingChanges, setPendingChanges] = useState<PendingChange[]>([
    {
      id: '1',
      editorId: '2',
      editorName: 'John Smith',
      departmentId: 'marketing',
      departmentName: 'Marketing',
      changeType: 'update',
      content: { title: 'Updated Marketing Campaign', description: 'New Q1 2024 campaign details' },
      status: 'pending_checker',
      createdAt: new Date('2024-01-15'),
    },
    {
      id: '2',
      editorId: '3',
      editorName: 'Sarah Johnson',
      departmentId: 'hr',
      departmentName: 'Human Resources',
      changeType: 'create',
      content: { title: 'New Employee Handbook', description: 'Updated policies and procedures' },
      status: 'pending_checker',
      createdAt: new Date('2024-01-14'),
    },
    {
      id: '3',
      editorId: '4',
      editorName: 'Mike Davis',
      departmentId: 'finance',
      departmentName: 'Finance',
      changeType: 'delete',
      content: { title: 'Old Financial Report', description: 'Removing outdated Q3 2023 report' },
      status: 'pending_checker',
      createdAt: new Date('2024-01-13'),
    }
  ]);

  const [selectedChanges, setSelectedChanges] = useState<string[]>([]);
  const [reviewNote, setReviewNote] = useState('');

  const handleSelectChange = (changeId: string) => {
    setSelectedChanges(prev => 
      prev.includes(changeId) 
        ? prev.filter(id => id !== changeId)
        : [...prev, changeId]
    );
  };

  const handleForwardToAdmin = (changeIds: string[], notes: string) => {
    setPendingChanges(prev => 
      prev.map(change => 
        changeIds.includes(change.id) 
          ? { ...change, status: 'pending_admin' as const, checkerNotes: notes, reviewedAt: new Date() }
          : change
      )
    );
    setSelectedChanges([]);
    setReviewNote('');
  };

  const handleRejectChange = (changeId: string, notes: string) => {
    setPendingChanges(prev => 
      prev.map(change => 
        change.id === changeId 
          ? { ...change, status: 'rejected' as const, checkerNotes: notes, reviewedAt: new Date() }
          : change
      )
    );
  };

  const getChangeTypeIcon = (type: string) => {
    switch (type) {
      case 'create':
        return <Plus className="w-4 h-4 text-green-600" />;
      case 'update':
        return <Edit className="w-4 h-4 text-blue-600" />;
      case 'delete':
        return <Trash2 className="w-4 h-4 text-red-600" />;
      default:
        return <FileText className="w-4 h-4 text-gray-600" />;
    }
  };

  const stats = {
    pending: pendingChanges.filter(c => c.status === 'pending_checker').length,
    forwarded: pendingChanges.filter(c => c.status === 'pending_admin').length,
    rejected: pendingChanges.filter(c => c.status === 'rejected').length,
    total: pendingChanges.length
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          Checker Dashboard
        </h1>
        <div className="flex items-center space-x-4">
          {selectedChanges.length > 0 && (
            <div className="flex items-center space-x-2">
              <span className="text-sm text-gray-600">{selectedChanges.length} selected</span>
              <button
                onClick={() => handleForwardToAdmin(selectedChanges, reviewNote)}
                className="bg-gradient-to-r from-[#777675] to-[#ffd332] text-white px-4 py-2 rounded-lg hover:shadow-lg transition-shadow duration-200 flex items-center gap-2"
              >
                <Send className="w-4 h-4" />
                Forward to Admin
              </button>
            </div>
          )}
        </div>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Pending Review</p>
              <p className="text-2xl font-bold text-orange-600">{stats.pending}</p>
            </div>
            <Clock className="w-8 h-8 text-orange-600" />
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Forwarded</p>
              <p className="text-2xl font-bold text-blue-600">{stats.forwarded}</p>
            </div>
            <Send className="w-8 h-8 text-blue-600" />
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Rejected</p>
              <p className="text-2xl font-bold text-red-600">{stats.rejected}</p>
            </div>
            <AlertCircle className="w-8 h-8 text-red-600" />
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total Reviewed</p>
              <p className="text-2xl font-bold text-[#777675]">{stats.total}</p>
            </div>
            <FileText className="w-8 h-8 text-[#777675]" />
          </div>
        </div>
      </div>

      {/* Review Notes */}
      {selectedChanges.length > 0 && (
        <div className="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
          <h2 className="text-lg font-semibold text-gray-800 mb-4">Review Notes</h2>
          <textarea
            value={reviewNote}
            onChange={(e) => setReviewNote(e.target.value)}
            className="w-full p-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
            rows={3}
            placeholder="Add notes for the selected changes..."
          />
        </div>
      )}

      {/* Pending Changes */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-xl font-semibold text-gray-800">Changes Awaiting Review</h2>
          <p className="text-gray-600 text-sm mt-1">Review and forward changes to CCM Admin for approval</p>
        </div>
        <div className="p-6">
          <div className="space-y-4">
            {pendingChanges.filter(c => c.status === 'pending_checker').map((change) => (
              <div key={change.id} className="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                <div className="flex items-start space-x-4">
                  <input
                    type="checkbox"
                    checked={selectedChanges.includes(change.id)}
                    onChange={() => handleSelectChange(change.id)}
                    className="mt-1 h-4 w-4 text-[#ffd332] focus:ring-[#ffd332] border-gray-300 rounded"
                  />
                  <div className="bg-gray-100 p-2 rounded-lg">
                    {getChangeTypeIcon(change.changeType)}
                  </div>
                  <div className="flex-1">
                    <div className="flex items-start justify-between">
                      <div>
                        <h3 className="font-medium text-gray-900">{change.content.title}</h3>
                        <p className="text-sm text-gray-600 mt-1">{change.content.description}</p>
                        <div className="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                          <span>Editor: {change.editorName}</span>
                          <span>Department: {change.departmentName}</span>
                          <span>Created: {change.createdAt.toLocaleDateString()}</span>
                          <span className="capitalize">Type: {change.changeType}</span>
                        </div>
                      </div>
                      <div className="flex items-center space-x-2">
                        <button className="p-2 text-gray-600 hover:text-[#777675] hover:bg-gray-100 rounded-lg transition-colors duration-200">
                          <Eye className="w-4 h-4" />
                        </button>
                        <button
                          onClick={() => handleRejectChange(change.id, 'Needs revision')}
                          className="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors duration-200"
                        >
                          <AlertCircle className="w-4 h-4" />
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Recently Forwarded */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-xl font-semibold text-gray-800">Recently Forwarded to Admin</h2>
        </div>
        <div className="p-6">
          <div className="space-y-4">
            {pendingChanges.filter(c => c.status === 'pending_admin').map((change) => (
              <div key={change.id} className="border border-gray-200 rounded-lg p-4">
                <div className="flex items-start space-x-3">
                  <div className="bg-blue-100 p-2 rounded-lg">
                    {getChangeTypeIcon(change.changeType)}
                  </div>
                  <div className="flex-1">
                    <h3 className="font-medium text-gray-900">{change.content.title}</h3>
                    <p className="text-sm text-gray-600 mt-1">{change.content.description}</p>
                    <div className="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                      <span>Editor: {change.editorName}</span>
                      <span>Department: {change.departmentName}</span>
                      <span>Forwarded: {change.reviewedAt?.toLocaleDateString()}</span>
                    </div>
                    {change.checkerNotes && (
                      <div className="mt-2 p-2 bg-blue-50 border border-blue-200 rounded text-sm">
                        <strong>Notes:</strong> {change.checkerNotes}
                      </div>
                    )}
                  </div>
                  <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <Clock className="w-3 h-3 mr-1" />
                    Awaiting Admin
                  </span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default CheckerDashboard;