import React, { useState } from 'react';
import { Building, Plus, Edit, Users, FileText, Calendar, Search, BarChart3 } from 'lucide-react';
import { Department } from '../../types';

const DepartmentManagement: React.FC = () => {
  const [departments, setDepartments] = useState<Department[]>([
    {
      id: 'oceo',
      name: 'OCEO',
      fullName: 'Office of the CEO',
      description: 'Executive leadership and strategic direction for NCRST',
      isActive: true,
      createdAt: new Date('2024-01-01'),
      updatedAt: new Date('2024-01-15'),
      editorCount: 2
    },
    {
      id: 'bss',
      name: 'BSS',
      fullName: 'Business Support Services',
      description: 'Administrative and operational support services',
      isActive: true,
      createdAt: new Date('2024-01-01'),
      updatedAt: new Date('2024-01-10'),
      editorCount: 2
    },
    {
      id: 'itd',
      name: 'ITD',
      fullName: 'Innovation & Technology Development',
      description: 'Technology innovation and development initiatives',
      isActive: true,
      createdAt: new Date('2024-01-01'),
      updatedAt: new Date('2024-01-12'),
      editorCount: 2
    },
    {
      id: 'rstcs',
      name: 'RSTCS',
      fullName: 'Research, Science & Technology Coordination and Supports',
      description: 'Research coordination and scientific technology support',
      isActive: true,
      createdAt: new Date('2024-01-01'),
      updatedAt: new Date('2024-01-08'),
      editorCount: 2
    }
  ]);

  const [showAddModal, setShowAddModal] = useState(false);
  const [editingDepartment, setEditingDepartment] = useState<Department | null>(null);
  const [searchTerm, setSearchTerm] = useState('');

  const [newDepartment, setNewDepartment] = useState({
    name: '',
    fullName: '',
    description: ''
  });

  const handleAddDepartment = () => {
    const department: Department = {
      id: newDepartment.name.toLowerCase().replace(/\s+/g, ''),
      name: newDepartment.name,
      fullName: newDepartment.fullName,
      description: newDepartment.description,
      isActive: true,
      createdAt: new Date(),
      updatedAt: new Date(),
      editorCount: 0
    };

    setDepartments(prev => [...prev, department]);
    setShowAddModal(false);
    setNewDepartment({ name: '', fullName: '', description: '' });
  };

  const handleEditDepartment = () => {
    if (editingDepartment) {
      setDepartments(prev => prev.map(dept => 
        dept.id === editingDepartment.id 
          ? { ...dept, ...editingDepartment, updatedAt: new Date() }
          : dept
      ));
      setEditingDepartment(null);
    }
  };

  const handleToggleStatus = (deptId: string) => {
    setDepartments(prev => prev.map(dept => 
      dept.id === deptId 
        ? { ...dept, isActive: !dept.isActive, updatedAt: new Date() }
        : dept
    ));
  };

  const filteredDepartments = departments.filter(dept =>
    dept.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    dept.fullName.toLowerCase().includes(searchTerm.toLowerCase()) ||
    dept.description.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const stats = {
    total: departments.length,
    active: departments.filter(d => d.isActive).length,
    inactive: departments.filter(d => !d.isActive).length,
    totalEditors: departments.reduce((sum, d) => sum + d.editorCount, 0)
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          Department Management
        </h1>
        <button
          onClick={() => setShowAddModal(true)}
          className="bg-gradient-to-r from-[#777675] to-[#ffd332] text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center gap-2 font-medium"
        >
          <Plus className="w-5 h-5" />
          Add Department
        </button>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total Departments</p>
              <p className="text-2xl font-bold text-[#777675]">{stats.total}</p>
            </div>
            <Building className="w-8 h-8 text-[#777675]" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Active</p>
              <p className="text-2xl font-bold text-green-600">{stats.active}</p>
            </div>
            <BarChart3 className="w-8 h-8 text-green-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Inactive</p>
              <p className="text-2xl font-bold text-red-600">{stats.inactive}</p>
            </div>
            <Building className="w-8 h-8 text-red-600" />
          </div>
        </div>
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total Editors</p>
              <p className="text-2xl font-bold text-blue-600">{stats.totalEditors}</p>
            </div>
            <Users className="w-8 h-8 text-blue-600" />
          </div>
        </div>
      </div>

      {/* Search */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <div className="relative">
          <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
          <input
            type="text"
            placeholder="Search departments..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
          />
        </div>
      </div>

      {/* Departments Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {filteredDepartments.map((department) => (
          <div key={department.id} className="bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-200">
            <div className="p-6">
              <div className="flex items-start justify-between mb-4">
                <div className="flex items-center space-x-3">
                  <div className="bg-gradient-to-r from-[#777675] to-[#ffd332] p-3 rounded-full">
                    <Building className="w-6 h-6 text-white" />
                  </div>
                  <div>
                    <h3 className="text-lg font-semibold text-gray-900">{department.name}</h3>
                    <p className="text-sm text-gray-600">{department.fullName}</p>
                  </div>
                </div>
                <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                  department.isActive 
                    ? 'bg-green-100 text-green-800' 
                    : 'bg-red-100 text-red-800'
                }`}>
                  {department.isActive ? 'Active' : 'Inactive'}
                </span>
              </div>

              <p className="text-gray-600 text-sm mb-4">{department.description}</p>

              <div className="grid grid-cols-2 gap-4 mb-4">
                <div className="bg-gray-50 p-3 rounded-lg">
                  <div className="flex items-center space-x-2">
                    <Users className="w-4 h-4 text-blue-600" />
                    <span className="text-sm font-medium text-gray-700">Editors</span>
                  </div>
                  <p className="text-lg font-bold text-blue-600 mt-1">{department.editorCount}</p>
                </div>
                <div className="bg-gray-50 p-3 rounded-lg">
                  <div className="flex items-center space-x-2">
                    <Calendar className="w-4 h-4 text-green-600" />
                    <span className="text-sm font-medium text-gray-700">Updated</span>
                  </div>
                  <p className="text-sm text-green-600 mt-1">{department.updatedAt.toLocaleDateString()}</p>
                </div>
              </div>

              <div className="flex justify-end space-x-2">
                <button
                  onClick={() => setEditingDepartment(department)}
                  className="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                >
                  <Edit className="w-4 h-4" />
                </button>
                <button
                  onClick={() => handleToggleStatus(department.id)}
                  className={`p-2 rounded-lg transition-colors duration-200 ${
                    department.isActive 
                      ? 'text-red-600 hover:text-red-800 hover:bg-red-50' 
                      : 'text-green-600 hover:text-green-800 hover:bg-green-50'
                  }`}
                >
                  <Building className="w-4 h-4" />
                </button>
                <button className="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                  <FileText className="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Add Department Modal */}
      {showAddModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-lg max-w-md w-full p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Add New Department</h3>
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Department Code</label>
                <input
                  type="text"
                  value={newDepartment.name}
                  onChange={(e) => setNewDepartment(prev => ({ ...prev, name: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  placeholder="e.g., OCEO"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input
                  type="text"
                  value={newDepartment.fullName}
                  onChange={(e) => setNewDepartment(prev => ({ ...prev, fullName: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  placeholder="Office of the CEO"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea
                  value={newDepartment.description}
                  onChange={(e) => setNewDepartment(prev => ({ ...prev, description: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  rows={3}
                  placeholder="Department description..."
                />
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
                onClick={handleAddDepartment}
                disabled={!newDepartment.name || !newDepartment.fullName}
                className="px-4 py-2 bg-gradient-to-r from-[#777675] to-[#ffd332] text-white rounded-lg hover:shadow-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Add Department
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Edit Department Modal */}
      {editingDepartment && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-lg max-w-md w-full p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Edit Department</h3>
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Department Code</label>
                <input
                  type="text"
                  value={editingDepartment.name}
                  onChange={(e) => setEditingDepartment(prev => prev ? { ...prev, name: e.target.value } : null)}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input
                  type="text"
                  value={editingDepartment.fullName}
                  onChange={(e) => setEditingDepartment(prev => prev ? { ...prev, fullName: e.target.value } : null)}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea
                  value={editingDepartment.description}
                  onChange={(e) => setEditingDepartment(prev => prev ? { ...prev, description: e.target.value } : null)}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  rows={3}
                />
              </div>
            </div>
            <div className="flex justify-end space-x-3 mt-6">
              <button
                onClick={() => setEditingDepartment(null)}
                className="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50"
              >
                Cancel
              </button>
              <button
                onClick={handleEditDepartment}
                className="px-4 py-2 bg-gradient-to-r from-[#777675] to-[#ffd332] text-white rounded-lg hover:shadow-lg transition-all duration-200"
              >
                Save Changes
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default DepartmentManagement;