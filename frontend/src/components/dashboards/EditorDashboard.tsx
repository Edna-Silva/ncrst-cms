import React, { useState } from 'react';
import { FileText, Clock, CheckCircle, AlertCircle, Edit, Trash2, Plus } from 'lucide-react';
import { PendingChange } from '../../types';

const EditorDashboard: React.FC = () => {
  const [myChanges] = useState<PendingChange[]>([
    {
      id: '1',
      editorId: '2',
      editorName: 'Current User',
      departmentId: 'marketing',
      departmentName: 'Marketing',
      changeType: 'update',
      content: { title: 'Updated Marketing Campaign', description: 'New Q1 2024 campaign details' },
      status: 'pending_checker',
      createdAt: new Date('2024-01-15'),
    },
    {
      id: '2',
      editorId: '2',
      editorName: 'Current User',
      departmentId: 'marketing',
      departmentName: 'Marketing',
      changeType: 'create',
      content: { title: 'New Product Launch', description: 'Introducing our latest product line' },
      status: 'pending_admin',
      createdAt: new Date('2024-01-14'),
    },
    {
      id: '3',
      editorId: '2',
      editorName: 'Current User',
      departmentId: 'marketing',
      departmentName: 'Marketing',
      changeType: 'delete',
      content: { title: 'Old Campaign Data', description: 'Removing outdated campaign information' },
      status: 'approved',
      approvedAt: new Date('2024-01-13'),
      createdAt: new Date('2024-01-12'),
    }
  ]);

  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'pending_checker':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
          <Clock className="w-3 h-3 mr-1" />
          Pending Review
        </span>;
      case 'pending_admin':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
          <Clock className="w-3 h-3 mr-1" />
          Pending Approval
        </span>;
      case 'approved':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
          <CheckCircle className="w-3 h-3 mr-1" />
          Approved
        </span>;
      case 'rejected':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
          <AlertCircle className="w-3 h-3 mr-1" />
          Rejected
        </span>;
      default:
        return null;
    }
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
    pending: myChanges.filter(c => c.status === 'pending_checker' || c.status === 'pending_admin').length,
    approved: myChanges.filter(c => c.status === 'approved').length,
    rejected: myChanges.filter(c => c.status === 'rejected').length,
    total: myChanges.length
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          Editor Dashboard
        </h1>
        <button className="bg-gradient-to-r from-[#777675] to-[#ffd332] text-white px-6 py-2 rounded-lg hover:shadow-lg transition-shadow duration-200 flex items-center gap-2">
          <Plus className="w-4 h-4" />
          New Content
        </button>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total Changes</p>
              <p className="text-2xl font-bold text-[#777675]">{stats.total}</p>
            </div>
            <FileText className="w-8 h-8 text-[#777675]" />
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Pending</p>
              <p className="text-2xl font-bold text-orange-600">{stats.pending}</p>
            </div>
            <Clock className="w-8 h-8 text-orange-600" />
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Approved</p>
              <p className="text-2xl font-bold text-green-600">{stats.approved}</p>
            </div>
            <CheckCircle className="w-8 h-8 text-green-600" />
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
      </div>

      {/* My Changes */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-xl font-semibold text-gray-800">My Changes</h2>
          <p className="text-gray-600 text-sm mt-1">Track the status of your submitted changes</p>
        </div>
        <div className="p-6">
          <div className="space-y-4">
            {myChanges.map((change) => (
              <div key={change.id} className="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                <div className="flex items-start justify-between">
                  <div className="flex items-start space-x-3">
                    <div className="bg-gray-100 p-2 rounded-lg">
                      {getChangeTypeIcon(change.changeType)}
                    </div>
                    <div>
                      <h3 className="font-medium text-gray-900">{change.content.title}</h3>
                      <p className="text-sm text-gray-600 mt-1">{change.content.description}</p>
                      <div className="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                        <span>Department: {change.departmentName}</span>
                        <span>Created: {change.createdAt.toLocaleDateString()}</span>
                        <span className="capitalize">Type: {change.changeType}</span>
                      </div>
                    </div>
                  </div>
                  <div className="flex flex-col items-end space-y-2">
                    {getStatusBadge(change.status)}
                    {change.status === 'pending_checker' || change.status === 'pending_admin' ? (
                      <button className="text-sm text-[#777675] hover:text-[#ffd332] transition-colors duration-200">
                        Edit
                      </button>
                    ) : null}
                  </div>
                </div>
                
                {change.status === 'rejected' && change.adminNotes && (
                  <div className="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                    <p className="text-sm text-red-800">
                      <strong>Rejection Reason:</strong> {change.adminNotes}
                    </p>
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Quick Actions */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-gradient-to-r from-[#777675] to-[#ffd332] rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow duration-200 cursor-pointer">
          <Plus className="w-8 h-8 mb-4" />
          <h3 className="text-lg font-semibold mb-2">Create Content</h3>
          <p className="text-sm opacity-90">Add new content to your department.</p>
        </div>

        <div className="bg-gradient-to-r from-[#ffd332] to-[#ffed4e] rounded-xl shadow-lg p-6 text-[#777675] hover:shadow-xl transition-shadow duration-200 cursor-pointer">
          <Edit className="w-8 h-8 mb-4" />
          <h3 className="text-lg font-semibold mb-2">Edit Content</h3>
          <p className="text-sm opacity-90">Update existing department content.</p>
        </div>

        <div className="bg-gradient-to-r from-[#666564] to-[#777675] rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow duration-200 cursor-pointer">
          <FileText className="w-8 h-8 mb-4" />
          <h3 className="text-lg font-semibold mb-2">View Guidelines</h3>
          <p className="text-sm opacity-90">Review content creation guidelines.</p>
        </div>
      </div>
    </div>
  );
};

export default EditorDashboard;