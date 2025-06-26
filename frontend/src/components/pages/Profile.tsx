import React, { useState } from 'react';
import { User, Key, Mail, Calendar, Shield, CheckCircle, AlertCircle } from 'lucide-react';
import { useAuth } from '../../contexts/AuthContext';

const Profile: React.FC = () => {
  const { user } = useAuth();
  const [showPasswordModal, setShowPasswordModal] = useState(false);
  const [passwordData, setPasswordData] = useState({
    currentPassword: '',
    newPassword: '',
    confirmPassword: ''
  });
  const [passwordMessage, setPasswordMessage] = useState<{ type: 'success' | 'error', text: string } | null>(null);

  const departments = [
    { id: 'oceo', name: 'OCEO', fullName: 'Office of the CEO' },
    { id: 'bss', name: 'BSS', fullName: 'Business Support Services' },
    { id: 'itd', name: 'ITD', fullName: 'Innovation & Technology Development' },
    { id: 'rstcs', name: 'RSTCS', fullName: 'Research, Science & Technology Coordination and Supports' }
  ];

  const handlePasswordSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setPasswordMessage(null);

    if (!passwordData.currentPassword) {
      setPasswordMessage({ type: 'error', text: 'Current password is required' });
      return;
    }

    if (passwordData.newPassword.length < 8) {
      setPasswordMessage({ type: 'error', text: 'New password must be at least 8 characters long' });
      return;
    }

    if (passwordData.newPassword !== passwordData.confirmPassword) {
      setPasswordMessage({ type: 'error', text: 'New passwords do not match' });
      return;
    }

    // Simulate API call
    setTimeout(() => {
      setPasswordMessage({ type: 'success', text: 'Password updated successfully!' });
      setPasswordData({ currentPassword: '', newPassword: '', confirmPassword: '' });
      setTimeout(() => {
        setShowPasswordModal(false);
        setPasswordMessage(null);
      }, 2000);
    }, 1000);
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
    return dept ? `${dept.name} - ${dept.fullName}` : 'N/A';
  };

  if (!user) return null;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          Profile
        </h1>
        <button
          onClick={() => setShowPasswordModal(true)}
          className="bg-gradient-to-r from-[#777675] to-[#ffd332] text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center gap-2 font-medium"
        >
          <Key className="w-5 h-5" />
          Change Password
        </button>
      </div>

      {/* Profile Card */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6">
          <div className="flex items-start space-x-6">
            <div className="bg-gradient-to-r from-[#777675] to-[#ffd332] p-6 rounded-full">
              <User className="w-12 h-12 text-white" />
            </div>
            <div className="flex-1">
              <div className="flex items-start justify-between mb-4">
                <div>
                  <h2 className="text-2xl font-bold text-gray-900">{user.email}</h2>
                  <p className="text-gray-600">NCRST User Account</p>
                </div>
                <span className={`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${getRoleBadgeColor(user.role)}`}>
                  <Shield className="w-4 h-4 mr-2" />
                  {getRoleLabel(user.role)}
                </span>
              </div>
              
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div className="bg-gray-50 p-4 rounded-lg">
                  <div className="flex items-center space-x-2 mb-2">
                    <Mail className="w-5 h-5 text-gray-600" />
                    <span className="text-sm font-medium text-gray-700">Email</span>
                  </div>
                  <p className="text-gray-900 font-medium">{user.email}</p>
                </div>

                <div className="bg-gray-50 p-4 rounded-lg">
                  <div className="flex items-center space-x-2 mb-2">
                    <Shield className="w-5 h-5 text-gray-600" />
                    <span className="text-sm font-medium text-gray-700">Role</span>
                  </div>
                  <p className="text-gray-900 font-medium">{getRoleLabel(user.role)}</p>
                </div>

                {user.department && (
                  <div className="bg-gray-50 p-4 rounded-lg">
                    <div className="flex items-center space-x-2 mb-2">
                      <User className="w-5 h-5 text-gray-600" />
                      <span className="text-sm font-medium text-gray-700">Department</span>
                    </div>
                    <p className="text-gray-900 font-medium">{getDepartmentName(user.department)}</p>
                  </div>
                )}

                <div className="bg-gray-50 p-4 rounded-lg">
                  <div className="flex items-center space-x-2 mb-2">
                    <Calendar className="w-5 h-5 text-gray-600" />
                    <span className="text-sm font-medium text-gray-700">Member Since</span>
                  </div>
                  <p className="text-gray-900 font-medium">{user.createdAt.toLocaleDateString()}</p>
                </div>

                <div className="bg-gray-50 p-4 rounded-lg">
                  <div className="flex items-center space-x-2 mb-2">
                    <Calendar className="w-5 h-5 text-gray-600" />
                    <span className="text-sm font-medium text-gray-700">Last Login</span>
                  </div>
                  <p className="text-gray-900 font-medium">
                    {user.lastLogin ? user.lastLogin.toLocaleDateString() : 'Never'}
                  </p>
                </div>

                <div className="bg-gray-50 p-4 rounded-lg">
                  <div className="flex items-center space-x-2 mb-2">
                    <CheckCircle className="w-5 h-5 text-green-600" />
                    <span className="text-sm font-medium text-gray-700">Status</span>
                  </div>
                  <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                    user.isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                  }`}>
                    {user.isActive ? 'Active' : 'Inactive'}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Role-specific Information */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h3 className="text-lg font-semibold text-gray-800">Role Information</h3>
        </div>
        <div className="p-6">
          {user.role === 'ccm_admin' && (
            <div className="space-y-4">
              <h4 className="font-medium text-gray-900">CCM Administrator Permissions</h4>
              <ul className="space-y-2 text-sm text-gray-600">
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Full access to all system features</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>User management and account creation</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Department management</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Final approval for all content changes</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>System configuration and settings</span>
                </li>
              </ul>
            </div>
          )}

          {user.role === 'editor' && (
            <div className="space-y-4">
              <h4 className="font-medium text-gray-900">Editor Permissions</h4>
              <ul className="space-y-2 text-sm text-gray-600">
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Create and edit content for your department ({getDepartmentName(user.department!)})</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Submit changes for checker review</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>View status of submitted changes</span>
                </li>
                <li className="flex items-center space-x-2">
                  <AlertCircle className="w-4 h-4 text-yellow-500" />
                  <span>Cannot publish content directly - requires approval</span>
                </li>
                <li className="flex items-center space-x-2">
                  <AlertCircle className="w-4 h-4 text-red-500" />
                  <span>Cannot edit content from other departments</span>
                </li>
              </ul>
            </div>
          )}

          {user.role === 'checker' && (
            <div className="space-y-4">
              <h4 className="font-medium text-gray-900">Checker Permissions</h4>
              <ul className="space-y-2 text-sm text-gray-600">
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Review changes from all departments</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Forward approved changes to CCM Admin</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Reject changes and send back to editors with notes</span>
                </li>
                <li className="flex items-center space-x-2">
                  <CheckCircle className="w-4 h-4 text-green-500" />
                  <span>Add review comments and feedback</span>
                </li>
                <li className="flex items-center space-x-2">
                  <AlertCircle className="w-4 h-4 text-yellow-500" />
                  <span>Cannot make final approval - only CCM Admin can approve</span>
                </li>
              </ul>
            </div>
          )}
        </div>
      </div>

      {/* Password Change Modal */}
      {showPasswordModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <div className="bg-white rounded-lg max-w-md w-full p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
            
            {passwordMessage && (
              <div className={`mb-4 p-3 rounded-lg ${
                passwordMessage.type === 'success' 
                  ? 'bg-green-50 border border-green-200 text-green-800' 
                  : 'bg-red-50 border border-red-200 text-red-800'
              }`}>
                <div className="flex items-center">
                  {passwordMessage.type === 'success' ? (
                    <CheckCircle className="w-4 h-4 mr-2" />
                  ) : (
                    <AlertCircle className="w-4 h-4 mr-2" />
                  )}
                  {passwordMessage.text}
                </div>
              </div>
            )}

            <form onSubmit={handlePasswordSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input
                  type="password"
                  value={passwordData.currentPassword}
                  onChange={(e) => setPasswordData(prev => ({ ...prev, currentPassword: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  required
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input
                  type="password"
                  value={passwordData.newPassword}
                  onChange={(e) => setPasswordData(prev => ({ ...prev, newPassword: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  minLength={8}
                  required
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                <input
                  type="password"
                  value={passwordData.confirmPassword}
                  onChange={(e) => setPasswordData(prev => ({ ...prev, confirmPassword: e.target.value }))}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ffd332] focus:border-transparent"
                  required
                />
              </div>
              <div className="flex justify-end space-x-3 pt-4">
                <button
                  type="button"
                  onClick={() => setShowPasswordModal(false)}
                  className="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  className="px-4 py-2 bg-gradient-to-r from-[#777675] to-[#ffd332] text-white rounded-lg hover:shadow-lg transition-all duration-200"
                >
                  Update Password
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default Profile;