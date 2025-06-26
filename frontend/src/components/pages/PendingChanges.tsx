import React, { useState } from 'react';
import { CheckCircle, XCircle, Clock, Eye, MessageSquare, ArrowLeft, Filter, Search } from 'lucide-react';
import { PendingChange } from '../../types';

const departments = [
  { id: 'oceo', name: 'OCEO', fullName: 'Office of the CEO' },
  { id: 'bss', name: 'BSS', fullName: 'Business Support Services' },
  { id: 'itd', name: 'ITD', fullName: 'Innovation & Technology Development' },
  { id: 'rstcs', name: 'RSTCS', fullName: 'Research, Science & Technology Coordination and Supports' }
];

const PendingChanges: React.FC = () => {
  const [changes, setChanges] = useState<PendingChange[]>([
    {
      id: '1',
      editorId: '2',
      editorName: 'John Smith',
      departmentId: 'oceo',
      departmentName: 'OCEO',
      changeType: 'update',
      content: { 
        title: 'CEO Message Update', 
        description: 'Updated quarterly message from the CEO',
        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...'
      },
      status: 'pending_admin',
      checkerNotes: 'Content reviewed and approved by checker. Ready for final approval.',
      checkedBy: 'checker',
      createdAt: new Date('2024-01-15'),
      reviewedAt: new Date('2024-01-16'),
    },
    {
      id: '2',
      editorId: '3',
      editorName: 'Sarah Johnson',
      departmentId: 'bss',
      departmentName: 'BSS',
      changeType: 'create',
      content: { 
        title: 'New HR Policy Document', 
        description: 'New employee handbook section',
        body: 'This document outlines the new remote work policies...'
      },
      status: 'pending_admin',
      checkerNotes: 'All policies verified against current regulations. Recommended for approval.',
      checkedBy: 'checker',
      createdAt: new Date('2024-01-14'),
      reviewedAt: new Date('2024-01-15'),
    },
    {
      id: '3',
      editorId: '4',
      editorName: 'Mike Davis',
      departmentId: 'itd',
      departmentName: 'ITD',
      changeType: 'delete',
      content: { 
        title: 'Outdated Technology Report', 
        description: 'Removing obsolete Q3 2023 technology assessment',
        body: 'This report is no longer relevant due to recent updates...'
      },
      status: 'pending_admin',
      checkerNotes: 'Confirmed that this report is outdated and should be removed.',
      checkedBy: 'checker',
      createdAt: new Date('2024-01-13'),
      reviewedAt: new Date('2024-01-14'),
    }
  ]);

  const [selectedChange, setSelectedChange] = useState<PendingChange | null>(null);
  const [approvalNote, setApprovalNote] = useState('');
  const [rejectionNote, setRejectionNote] = useState('');
  const [statusFilter, setStatusFilter] = useState('pending_admin');
  const [departmentFilter, setDepartmentFilter] = useState('all');
  const [searchTerm, setSearchTerm] = useState('');

  const handleApprove = (changeId: string, note: string) => {
    setChanges(prev => prev.map(change => 
      change.id === changeId 
        ? { 
            ...change, 
            status: 'approved' as const, 
            adminNotes: note, 
            approvedAt: new Date(),
            approvedBy: 'admin'
          }
        : change
    ));
    setSelectedChange(null);
    setApprovalNote('');
  };

  const handleSendBack = (changeId: string, note: string) => {
    setChanges(prev => prev.map(change => 
      change.id === changeId 
        ? { 
            ...change, 
            status: 'sent_back' as const, 
            adminNotes: note, 
            reviewedAt: new Date()
          }
        : change
    ));
    setSelectedChange(null);
    setRejectionNote('');
  };

  const getChangeTypeIcon = (type: string) => {
    switch (type) {
      case 'create':
        return '➕';
      case 'update':
        return '✏️';
      case 'delete':
        return '🗑️';
      default:
        return '📄';
    }
  };

  const getChangeTypeColor = (type: string) => {
    switch (type) {
      case 'create':
        return 'bg-green-100 text-green-800';
      case 'update':
        return 'bg-blue-100 text-blue-800';
      case 'delete':
        return 'bg-red-100 text-red-800';
      default:
        return 'bg-gray-100 text-gray-800';
    }
  };

  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'pending_admin':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
          <Clock className="w-3 h-3 mr-1" />
          Pending Approval
        </span>;
      case 'approved':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
          <CheckCircle className="w-3 h-3 mr-1" />
          Approved
        </span>;
      case 'sent_back':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
          <XCircle className="w-3 h-3 mr-1" />
          Sent Back
        </span>;
      default:
        return null;
    }
  };

  const filteredChanges = changes.filter(change => {
    const matchesStatus = statusFilter === 'all' || change.status === statusFilter;
    const matchesDepartment = departmentFilter === 'all' || change.departmentId === departmentFilter;
    const matchesSearch = searchTerm === '' || 
      change.content.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
      change.editorName.toLowerCase().includes(searchTerm.toLowerCase()) ||
      change.departmentName.toLowerCase().includes(searchTerm.toLowerCase());
    
    return matchesStatus && matchesDepartment && matchesSearch;
  });

  const stats = {
    pending: changes.filter(c => c.status === 'pending_admin').length,
    approved: changes.filter(c => c.status === 'approved').length,
    sentBack: changes.filter(c => c.status === 'sent_back').length,
    total: changes.length
  };

  if (selectedChange) {
    return (
      <div className="space-y-6">
        <div className="flex items-center space-x-4">
          <button
            onClick={() => setSelectedChange(null)}
            className="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors duration-200"
          >
            <ArrowLeft className="w-5 h-5" />
          </button>
          <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
            Review Change
          </h1>
        </div>

        <div className="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
          <div className="space-y-6">
            {/* Change Details */}
            <div className="border-b border-gray-200 pb-4">
              <div className="flex items-start justify-between mb-4">
                <div>
                  <h2 className="text-xl font-semibold text-gray-900">{selectedChange.content.title}</h2>
                  <p className="text-gray-600 mt-1">{selectedChange.content.description}</p>
                </div>
                <div className="flex items-center space-x-2">
                  <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getChangeTypeColor(selectedChange.changeType)}`}>
                    {getChangeTypeIcon(selectedChange.changeType)} {selectedChange.changeType.toUpperCase()}
                  </span>
                  {getStatusBadge(selectedChange.status)}
                </div>
              </div>
              
              <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600">
                <div>
                  <span className="font-medium">Editor:</span>
                  <p>{selectedChange.editorName}</p>
                </div>
                <div>
                  <span className="font-medium">Department:</span>
                  <p>{selectedChange.departmentName}</p>
                </div>
                <div>
                  <span className="font-medium">Created:</span>
                  <p>{selectedChange.createdAt.toLocaleDateString()}</p>
                </div>
                <div>
                  <span className="font-medium">Reviewed:</span>
                  <p>{selectedChange.reviewedAt?.toLocaleDateString() || 'Pending'}</p>
                </div>
              </div>
            </div>

            {/* Content Preview */}
            <div>
              <h3 className="text-lg font-medium text-gray-900 mb-3">Content Preview</h3>
              <div className="bg-gray-50 p-4 rounded-lg">
                <div className="prose max-w-none">
                  <p className="text-gray-700 whitespace-pre-wrap">{selectedChange.content.body}</p>
                </div>
              </div>
            </div>

            {/* Checker Notes */}
            {selectedChange.checkerNotes && (
              <div>
                <h3 className="text-lg font-medium text-gray-900 mb-3">Checker Notes</h3>
                <div className="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                  <p className="text-blue-800">{selectedChange.checkerNotes}</p>
                  <p className="text-blue-600 text-sm mt-2">Reviewed by: {selectedChange.checkedBy}</p>
                </div>
              </div>
            )}

            {/* Approval Actions */}
            <div className="border-t border-gray-200 pt-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                {/* Approve */}
                <div className="space-y-3">
                  <h4 className="font-medium text-gray-900 flex items-center">
                    <CheckCircle className="w-5 h-5 text-green-600 mr-2" />
                    Approve Change
                  </h4>
                  <textarea
                    value={approvalNote}
                    onChange={(e) => setApprovalNote(e.target.value)}
                    className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                    rows={3}
                    placeholder="Add approval notes (optional)..."
                  />
                  <button
                    onClick={() => handleApprove(selectedChange.id, approvalNote)}
                    className="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 px-4 rounded-lg hover:shadow-lg transition-all duration-200 font-medium"
                  >
                    Approve Change
                  </button>
                </div>

                {/* Send Back */}
                <div className="space-y-3">
                  <h4 className="font-medium text-gray-900 flex items-center">
                    <XCircle className="w-5 h-5 text-red-600 mr-2" />
                    Send Back for Amendment
                  </h4>
                  <textarea
                    value={rejectionNote}
                    onChange={(e) => setRejectionNote(e.target.value)}
                    className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"
                    rows={3}
                    placeholder="Explain what needs to be amended..."
                    required
                  />
                  <button
                    onClick={() => handleSendBack(selectedChange.id, rejectionNote)}
                    disabled={!rejectionNote.trim()}
                    className="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-4 rounded-lg hover:shadow-lg transition-all duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    Send Back for Amendment
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          Pending Changes
        </h1>
        <div className="text-sm text-gray-500">
          {stats.pending} changes awaiting approval
        </div>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Pending Approval</p>
              <p className="text-2xl font-bold text-yellow-600">{stats.pending}</p>
            </div>
            <Clock className="w-8 h-8 text-yellow-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Approved</p>
              <p className="text-2xl font-bold text-green-600">{stats.approved}</p>
            </div>
            <CheckCircle className="w-8 h-8 text-green-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Sent Back</p>
              <p className="text-2xl font-bold text-red-600">{stats.sentBack}</p>
            </div>
            <XCircle className="w-8 h-8 text-red-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total</p>
              <p className="text-2xl font-bold text-[#777675]">{stats.total}</p>
            </div>
            <MessageSquare className="w-8 h-8 text-[#777675]" />
          </div>
        </div>
      </div>

      {/* Filters */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <div className="flex flex-col md:flex-row gap-4">
          <div className="flex-1">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
              <input
                type="text"
                placeholder="Search changes..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
              />
            </div>
          </div>
          <div className="flex items-center gap-2">
            <Filter className="w-5 h-5 text-gray-400" />
            <select
              value={statusFilter}
              onChange={(e) => setStatusFilter(e.target.value)}
              className="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
            >
              <option value="all">All Status</option>
              <option value="pending_admin">Pending Approval</option>
              <option value="approved">Approved</option>
              <option value="sent_back">Sent Back</option>
            </select>
            <select
              value={departmentFilter}
              onChange={(e) => setDepartmentFilter(e.target.value)}
              className="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
            >
              <option value="all">All Departments</option>
              {departments.map(dept => (
                <option key={dept.id} value={dept.id}>{dept.name}</option>
              ))}
            </select>
          </div>
        </div>
      </div>

      {/* Changes List */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-xl font-semibold text-gray-800">Changes ({filteredChanges.length})</h2>
        </div>
        <div className="p-6">
          <div className="space-y-4">
            {filteredChanges.map((change) => (
              <div key={change.id} className="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                <div className="flex items-start justify-between">
                  <div className="flex-1">
                    <div className="flex items-start justify-between mb-2">
                      <h3 className="font-medium text-gray-900">{change.content.title}</h3>
                      <div className="flex items-center space-x-2">
                        <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getChangeTypeColor(change.changeType)}`}>
                          {getChangeTypeIcon(change.changeType)} {change.changeType.toUpperCase()}
                        </span>
                        {getStatusBadge(change.status)}
                      </div>
                    </div>
                    <p className="text-sm text-gray-600 mb-2">{change.content.description}</p>
                    <div className="flex items-center space-x-4 text-xs text-gray-500">
                      <span>Editor: {change.editorName}</span>
                      <span>Department: {change.departmentName}</span>
                      <span>Created: {change.createdAt.toLocaleDateString()}</span>
                      {change.reviewedAt && <span>Reviewed: {change.reviewedAt.toLocaleDateString()}</span>}
                    </div>
                    {change.checkerNotes && (
                      <div className="mt-2 p-2 bg-blue-50 border border-blue-200 rounded text-sm">
                        <strong>Checker Notes:</strong> {change.checkerNotes}
                      </div>
                    )}
                  </div>
                  <div className="ml-4 flex flex-col space-y-2">
                    <button
                      onClick={() => setSelectedChange(change)}
                      className="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors duration-200 flex items-center gap-1"
                    >
                      <Eye className="w-4 h-4" />
                      <span className="text-xs">Review</span>
                    </button>
                  </div>
                </div>
              </div>
            ))}
            {filteredChanges.length === 0 && (
              <div className="text-center py-8 text-gray-500">
                <MessageSquare className="w-12 h-12 mx-auto mb-4 text-gray-300" />
                <p>No changes found matching your criteria.</p>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default PendingChanges;