import React, { useState } from 'react';
import { Users, Building, FileText, CheckCircle, AlertCircle, Clock, TrendingUp } from 'lucide-react';
import { DashboardStats } from '../../types';

const CCMAdminDashboard: React.FC = () => {
  const [stats] = useState<DashboardStats>({
    totalUsers: 45,
    totalDepartments: 12,
    pendingChanges: 8,
    approvedChanges: 127
  });

  const recentActivity = [
    { id: 1, action: 'New user created', user: 'John Doe - Marketing Editor', time: '10 minutes ago', type: 'user' },
    { id: 2, action: 'Change approved', user: 'Content update for HR Department', time: '1 hour ago', type: 'approval' },
    { id: 3, action: 'Change rejected', user: 'Finance department content', time: '2 hours ago', type: 'rejection' },
    { id: 4, action: 'New department added', user: 'Customer Service Department', time: '1 day ago', type: 'department' }
  ];

  const getActivityIcon = (type: string) => {
    switch (type) {
      case 'user': return <Users className="w-4 h-4" />;
      case 'approval': return <CheckCircle className="w-4 h-4" />;
      case 'rejection': return <AlertCircle className="w-4 h-4" />;
      case 'department': return <Building className="w-4 h-4" />;
      default: return <FileText className="w-4 h-4" />;
    }
  };

  const getActivityColor = (type: string) => {
    switch (type) {
      case 'user': return 'text-blue-600 bg-blue-100';
      case 'approval': return 'text-green-600 bg-green-100';
      case 'rejection': return 'text-red-600 bg-red-100';
      case 'department': return 'text-purple-600 bg-purple-100';
      default: return 'text-gray-600 bg-gray-100';
    }
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold bg-gradient-to-r from-[#777675] to-[#ffd332] bg-clip-text text-transparent">
          CCM Admin Dashboard
        </h1>
        <div className="text-sm text-gray-500">
          Last updated: {new Date().toLocaleString()}
        </div>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Total Users</p>
              <p className="text-3xl font-bold text-[#777675]">{stats.totalUsers}</p>
            </div>
            <div className="bg-gradient-to-r from-[#777675] to-[#ffd332] p-3 rounded-full">
              <Users className="w-6 h-6 text-white" />
            </div>
          </div>
          <div className="mt-4 flex items-center text-sm">
            <TrendingUp className="w-4 h-4 text-green-500 mr-1" />
            <span className="text-green-500">+12%</span>
            <span className="text-gray-500 ml-1">from last month</span>
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Departments</p>
              <p className="text-3xl font-bold text-[#777675]">{stats.totalDepartments}</p>
            </div>
            <div className="bg-gradient-to-r from-[#ffd332] to-[#ffed4e] p-3 rounded-full">
              <Building className="w-6 h-6 text-[#777675]" />
            </div>
          </div>
          <div className="mt-4 flex items-center text-sm">
            <TrendingUp className="w-4 h-4 text-green-500 mr-1" />
            <span className="text-green-500">+2</span>
            <span className="text-gray-500 ml-1">new this quarter</span>
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Pending Changes</p>
              <p className="text-3xl font-bold text-orange-600">{stats.pendingChanges}</p>
            </div>
            <div className="bg-gradient-to-r from-orange-500 to-orange-600 p-3 rounded-full">
              <Clock className="w-6 h-6 text-white" />
            </div>
          </div>
          <div className="mt-4 flex items-center text-sm">
            <AlertCircle className="w-4 h-4 text-orange-500 mr-1" />
            <span className="text-orange-500">Requires attention</span>
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600">Approved Changes</p>
              <p className="text-3xl font-bold text-green-600">{stats.approvedChanges}</p>
            </div>
            <div className="bg-gradient-to-r from-green-500 to-green-600 p-3 rounded-full">
              <CheckCircle className="w-6 h-6 text-white" />
            </div>
          </div>
          <div className="mt-4 flex items-center text-sm">
            <TrendingUp className="w-4 h-4 text-green-500 mr-1" />
            <span className="text-green-500">+23</span>
            <span className="text-gray-500 ml-1">this week</span>
          </div>
        </div>
      </div>

      {/* Recent Activity */}
      <div className="bg-white rounded-xl shadow-lg border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-xl font-semibold text-gray-800">Recent Activity</h2>
        </div>
        <div className="p-6">
          <div className="space-y-4">
            {recentActivity.map((activity) => (
              <div key={activity.id} className="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                <div className={`p-2 rounded-full ${getActivityColor(activity.type)}`}>
                  {getActivityIcon(activity.type)}
                </div>
                <div className="flex-1 min-w-0">
                  <p className="text-sm font-medium text-gray-900">{activity.action}</p>
                  <p className="text-sm text-gray-500">{activity.user}</p>
                </div>
                <div className="text-xs text-gray-400">
                  {activity.time}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Quick Actions */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div className="bg-gradient-to-r from-[#777675] to-[#ffd332] rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow duration-200 cursor-pointer">
          <Users className="w-8 h-8 mb-4" />
          <h3 className="text-lg font-semibold mb-2">Manage Users</h3>
          <p className="text-sm opacity-90">Create, edit, and manage user accounts across all departments.</p>
        </div>

        <div className="bg-gradient-to-r from-[#ffd332] to-[#ffed4e] rounded-xl shadow-lg p-6 text-[#777675] hover:shadow-xl transition-shadow duration-200 cursor-pointer">
          <FileText className="w-8 h-8 mb-4" />
          <h3 className="text-lg font-semibold mb-2">Review Changes</h3>
          <p className="text-sm opacity-90">Approve or reject pending changes from all departments.</p>
        </div>

        <div className="bg-gradient-to-r from-[#666564] to-[#777675] rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow duration-200 cursor-pointer">
          <Building className="w-8 h-8 mb-4" />
          <h3 className="text-lg font-semibold mb-2">Department Settings</h3>
          <p className="text-sm opacity-90">Configure department settings and permissions.</p>
        </div>
      </div>
    </div>
  );
};

export default CCMAdminDashboard;