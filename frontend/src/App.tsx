import React, { useState } from 'react';
import { AuthProvider, useAuth } from './contexts/AuthContext';
import Login from './components/Login';
import Layout from './components/Layout';
import CCMAdminDashboard from './components/dashboards/CCMAdminDashboard';
import EditorDashboard from './components/dashboards/EditorDashboard';
import CheckerDashboard from './components/dashboards/CheckerDashboard';
import UserManagement from './components/pages/UserManagement';
import DepartmentManagement from './components/pages/DepartmentManagement';
import PendingChanges from './components/pages/PendingChanges';
import Profile from './components/pages/Profile';

const AppContent: React.FC = () => {
  const { isAuthenticated, user } = useAuth();
  const [currentPage, setCurrentPage] = useState('dashboard');

  if (!isAuthenticated) {
    return <Login />;
  }

  const renderPage = () => {
    switch (currentPage) {
      case 'dashboard':
        if (user?.role === 'ccm_admin') return <CCMAdminDashboard />;
        if (user?.role === 'editor') return <EditorDashboard />;
        if (user?.role === 'checker') return <CheckerDashboard />;
        break;
      case 'users':
        return user?.role === 'ccm_admin' ? <UserManagement /> : <div>Access Denied</div>;
      case 'departments':
        return user?.role === 'ccm_admin' ? <DepartmentManagement /> : <div>Access Denied</div>;
      case 'pending-changes':
        return user?.role === 'ccm_admin' ? <PendingChanges /> : <div>Access Denied</div>;
      case 'profile':
        return <Profile />;
      default:
        return <div>Page not found</div>;
    }
  };

  return (
    <Layout currentPage={currentPage} onPageChange={setCurrentPage}>
      {renderPage()}
    </Layout>
  );
};

function App() {
  return (
    <AuthProvider>
      <AppContent />
    </AuthProvider>
  );
}

export default App;