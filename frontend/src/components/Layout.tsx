import React from 'react';
import { useAuth } from '../contexts/AuthContext';
import { LogOut, User, Settings, Building, FileText, Users, CheckCircle } from 'lucide-react';

interface LayoutProps {
  children: React.ReactNode;
  currentPage: string;
  onPageChange: (page: string) => void;
}

const Layout: React.FC<LayoutProps> = ({ children, currentPage, onPageChange }) => {
  const { user, logout } = useAuth();

  const getNavigationItems = () => {
    const baseItems = [
      { id: 'dashboard', label: 'Dashboard', icon: Building },
      { id: 'profile', label: 'Profile', icon: User }
    ];

    if (user?.role === 'ccm_admin') {
      return [
        ...baseItems,
        { id: 'users', label: 'User Management', icon: Users },
        { id: 'departments', label: 'Departments', icon: Building },
        { id: 'pending-changes', label: 'Pending Changes', icon: FileText },
        { id: 'settings', label: 'Settings', icon: Settings }
      ];
    } else if (user?.role === 'editor') {
      return [
        ...baseItems,
        { id: 'content', label: 'Content Management', icon: FileText },
        { id: 'my-changes', label: 'My Changes', icon: CheckCircle }
      ];
    } else if (user?.role === 'checker') {
      return [
        ...baseItems,
        { id: 'review-changes', label: 'Review Changes', icon: CheckCircle },
        { id: 'all-changes', label: 'All Changes', icon: FileText }
      ];
    }

    return baseItems;
  };

  const navigationItems = getNavigationItems();

  const getRoleLabel = (role: string) => {
    switch (role) {
      case 'ccm_admin': return 'CCM Administrator';
      case 'editor': return 'Editor';
      case 'checker': return 'Checker';
      default: return role;
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
      {/* Sidebar */}
      <div className="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#777675] to-[#555453] shadow-xl">
        <div className="flex items-center justify-center h-16 bg-gradient-to-r from-[#777675] to-[#ffd332]">
          <Building className="w-8 h-8 text-white mr-2" />
          <span className="text-white text-xl font-bold">NCRST Portal</span>
        </div>
        
        <nav className="mt-8">
          {navigationItems.map((item) => {
            const Icon = item.icon;
            return (
              <button
                key={item.id}
                onClick={() => onPageChange(item.id)}
                className={`w-full flex items-center px-6 py-3 text-left transition-all duration-200 ${
                  currentPage === item.id
                    ? 'bg-gradient-to-r from-[#ffd332] to-[#ffed4e] text-[#777675] shadow-lg'
                    : 'text-gray-300 hover:bg-[#666564] hover:text-white'
                }`}
              >
                <Icon className="w-5 h-5 mr-3" />
                {item.label}
              </button>
            );
          })}
        </nav>

        <div className="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-600">
          <div className="flex items-center mb-4">
            <div className="bg-gradient-to-r from-[#ffd332] to-[#ffed4e] p-2 rounded-full">
              <User className="w-5 h-5 text-[#777675]" />
            </div>
            <div className="ml-3">
              <p className="text-white font-medium text-sm">{user?.email}</p>
              <p className="text-gray-300 text-xs">{getRoleLabel(user?.role || '')}</p>
            </div>
          </div>
          <button
            onClick={logout}
            className="w-full flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200"
          >
            <LogOut className="w-4 h-4 mr-2" />
            Logout
          </button>
        </div>
      </div>

      {/* Main Content */}
      <div className="ml-64">
        <div className="p-8">
          {children}
        </div>
      </div>
    </div>
  );
};

export default Layout;