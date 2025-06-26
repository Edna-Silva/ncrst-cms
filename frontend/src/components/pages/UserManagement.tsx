import React, { useState } from 'react';
import { Users, Plus, Edit, Trash2, Eye, Key, Search, Filter, AlertCircle, CheckCircle } from 'lucide-react';
import { User } from '../../types';

const departments = [
  { id: 'oceo', name: 'OCEO', fullName: 'Office of the CEO' },
  { id: 'bss', name: 'BSS', fullName: 'Business Support Services' },
  { id: 'itd', name: 'ITD', fullName: 'Innovation & Technology Development' },
  { id: 'rstcs', name: 'RSTCS', fullName: 'Research, Science & Technology Coordination and Supports' }
];

const UserManagement: React.FC = () => {
  const [users, setUsers] = useState<User[]>([
    {
      id: '1',
      username: 'admin@ncrst.na',
      email: 'admin@ncrst.na',
      role: 'ccm_admin',
      isActive: true,
      createdAt: new Date('2024-01-01'),
      lastLogin: new Date()
    },
    {
      id: '2',
      username: 'oceo.editor1@ncrst.na',
      email: 'oceo.editor1@ncrst.na',
      role: 'editor',
      department: 'oceo',
      isActive: true,
      createdAt: new Date('2024-01-15'),
      lastLogin: new Date()
    },
    {
      id: '3',
      username: 'bss.editor1@ncrst.na',
      email: 'bss.editor1@ncrst.na',
      role: 'editor',
      department: 'bss',
      isActive: true,
      createdAt: new Date('2024-01-12'),
      lastLogin: new Date()
    },
    {
      id: '4',
      username: 'checker@ncrst.na',
      email: 'checker@ncrst.na',
      role: 'checker',
      isActive: true,
      createdAt: new Date('2024-01-10'),
      lastLogin: new Date()
    }
  ]);

  const [showAddModal, setShowAddModal] = useState(false);
  const [editingUser, setEditingUser] = useState<User | null>(null);
  const [searchTerm, setSearchTerm] = useState('');
  const [roleFilter, setRoleFilter] = useState('all');

  const [newUser, setNewUser] = useState({
    email: '',
    role: 'editor' as const,
    department: '',
    password: ''
  });

  const generatePassword = () => {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
    let password = '';
    for (let i = 0; i < 12; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    setNewUser(prev => ({ ...prev, password }));
  };

  const handleAddUser = () => {
    const user: User = {
      id: Date.now().toString(),
      username: newUser.email,
      email: newUser.email,
      role: newUser.role,
      department: newUser.role === 'editor' ? newUser.department : undefined,
      isActive: true,
      createdAt: new Date(),
    };

    setUsers(prev => [...prev, user]);
    setShowAddModal(false);
    setNewUser({ email: '', role: 'editor', department: '', password: '' });
  };

  const handleDeleteUser = (userId: string) => {
    if (window.confirm('Are you sure you want to delete this user?')) {
      setUsers(prev => prev.filter(u => u.id !== userId));
    }
  };

  const handleToggleStatus = (userId: string) => {
    setUsers(prev => prev.map(u => 
      u.id === userId ? { ...u, isActive: !u.isActive } : u
    ));
  };

  const getRoleLabel = (role: string) => {
    switch (role) {
      case 'ccm_admin': return 'CCM Administrator';
      case 'editor': return 'Editor';
      case 'checker': return 'Checker';
      default: return role;
    }
  };

  const getRoleBadgeColor = (role: string) => {
    switch (role) {
      case 'ccm_admin': return 'bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800';
      case 'editor': return 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800';
      case 'checker': return 'bg-gradient-to-r from-green-100 to-green-200 text-green-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  };

  const getDepartmentName = (deptId: string) => {
    const dept = departments.find(d => d.id === deptId);
    return dept ? dept.name : deptId?.toUpperCase();
  };

  const filteredUsers = users.filter(user => {
    const matchesSearch = user.email.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesRole = roleFilter === 'all' || user.role === roleFilter;
    return matchesSearch && matchesRole;
  });

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          User Management
        </h1>
        <button
          onClick={() => setShowAddModal(true)}
          className="bg-gradient-to-r from-[#777675] to-[#ffd332] text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center gap-2 font-medium"
        >
          <Plus className="w-5 h-5" />
          Add User
        </button>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total Users</p>
              <p className="text-2xl font-bold text-[#777675]">{users.length}</p>
            </div>
            <Users className="w-8 h-8 text-[#777675]" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Editors</p>
              <p className="text-2xl font-bold text-blue-600">{users.filter(u => u.role === 'editor').length}</p>
            </div>
            <Edit className="w-8 h-8 text-blue-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Checkers</p>
              <p className="text-2xl font-bold text-green-600">{users.filter(u => u.role === 'checker').length}</p>
            </div>
            <Eye className="w-8 h-8 text-green-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Active Users</p>
              <p className="text-2xl font-bold text-green-600">{users.filter(u => u.isActive).length}</p>
            </div>
            <CheckCircle className="w-8 h-8 text-green-600" />
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
                placeholder="Search users by email..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
              />
            </div>
          </div>
          <div className="flex items-center gap-2">
            <Filter className="w-5 h-5 text-gray-400" />
            <select
              value={roleFilter}
              onChange={(e) => setRoleFilter(e.target.value)}
              className="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
            >
              <option value="all">All Roles</option>
              <option value="ccm_admin">CCM Admin</option>
              <option value="editor">Editor</option>
              <option value="checker">Checker</option>
            </select>
          </div>
        </div>
      </div>

      {/* Users Table */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-xl font-semibold text-gray-800">Users ({filteredUsers.length})</h2>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {filteredUsers.map((user) => (
                <tr key={user.id} className="hover:bg-gray-50">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm font-medium text-gray-900">{user.email}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getRoleBadgeColor(user.role)}`}>
                      {getRoleLabel(user.role)}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {user.department ? getDepartmentName(user.department) : '-'}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                      user.isActive 
                        ? 'bg-green-100 text-green-800' 
                        : 'bg-red-100 text-red-800'
                    }`}>
                      {user.isActive ? 'Active' : 'Inactive'}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {user.lastLogin ? user.lastLogin.toLocaleDateString() : 'Never'}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div className="flex space-x-2">
                      <button
                        onClick={() => setEditingUser(user)}
                        className="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                      >
                        <Edit className="w-4 h-4" />
                      </button>
                      <button
                        onClick={() => handleToggleStatus(user.id)}
                        className={`p-1 rounded ${
                          user.isActive 
                            ? 'text-red-600 hover:text-red-900 hover:bg-red-50' 
                            : 'text-green-600 hover:text-green-900 hover:bg-green-50'
                        }`}
                      >
                        {user.isActive ? <AlertCircle className="w-4 h-4" /> : <CheckCircle className="w-4 h-4" />}
                      </button>
                      <button className="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-50">
                        <Key className="w-4 h-4" />
                      </button>
                      <button
                        onClick={() => handleDeleteUser(user.id)}
                        className="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                      >
                        <Trash2 className="w-4 h-4" />
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      {/* Add User Modal */}
      {showAddModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-lg max-w-md w-full p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Add New User</h3>
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input
                  type="email"
                  value={newUser.email}
                  onChange={(e) => setNewUser(prev => ({ ...prev, email: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  placeholder="user@ncrst.na"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select
                  value={newUser.role}
                  onChange={(e) => setNewUser(prev => ({ ...prev, role: e.target.value as any }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                >
                  <option value="editor">Editor</option>
                  <option value="checker">Checker</option>
                  <option value="ccm_admin">CCM Administrator</option>
                </select>
              </div>
              {newUser.role === 'editor' && (
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-1">Department</label>
                  <select
                    value={newUser.department}
                    onChange={(e) => setNewUser(prev => ({ ...prev, department: e.target.value }))}
                    className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                    required
                  >
                    <option value="">Select Department</option>
                    {departments.map(dept => (
                      <option key={dept.id} value={dept.id}>{dept.name} - {dept.fullName}</option>
                    ))}
                  </select>
                </div>
              )}
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div className="flex gap-2">
                  <input
                    type="text"
                    value={newUser.password}
                    onChange={(e) => setNewUser(prev => ({ ...prev, password: e.target.value }))}
                    className="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                    placeholder="Enter password"
                  />
                  <button
                    type="button"
                    onClick={generatePassword}
                    className="px-3 py-2 bg-gradient-to-r from-[#777675] to-[#ffd332] text-white rounded-lg hover:shadow-lg transition-all duration-200"
                  >
                    Generate
                  </button>
                </div>
              </div>
            </div>
            <div className="flex justify-end space-x-3 mt-6">
              <button
                onClick={() => setShowAddModal(false)}
                className="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50"
              >
                Cancel
              </button>
              <button
                onClick={handleAddUser}
                disabled={!newUser.email || !newUser.password || (newUser.role === 'editor' && !newUser.department)}
                className="px-4 py-2 bg-gradient-to-r from-[#777675] to-[#ffd332] text-white rounded-lg hover:shadow-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Add User
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default UserManagement;