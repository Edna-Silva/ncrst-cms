import React, { createContext, useContext, useState, useEffect } from 'react';
import { User, AuthContextType } from '../types';

const AuthContext = createContext<AuthContextType | undefined>(undefined);

// Mock data with the specified departments
const mockUsers: User[] = [
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
    username: 'itd.editor1@ncrst.na',
    email: 'itd.editor1@ncrst.na',
    role: 'editor',
    department: 'itd',
    isActive: true,
    createdAt: new Date('2024-01-10'),
    lastLogin: new Date()
  },
  {
    id: '5',
    username: 'rstcs.editor1@ncrst.na',
    email: 'rstcs.editor1@ncrst.na',
    role: 'editor',
    department: 'rstcs',
    isActive: true,
    createdAt: new Date('2024-01-08'),
    lastLogin: new Date()
  },
  {
    id: '6',
    username: 'checker@ncrst.na',
    email: 'checker@ncrst.na',
    role: 'checker',
    isActive: true,
    createdAt: new Date('2024-01-05'),
    lastLogin: new Date()
  }
];

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [twoFactorRequired, setTwoFactorRequired] = useState(false);

  useEffect(() => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      setUser(JSON.parse(storedUser));
      setIsAuthenticated(true);
    }
  }, []);

  const login = async (email: string, password: string, twoFactorCode?: string): Promise<boolean> => {
    // Mock login - in production, this would call your PHP backend
    const foundUser = mockUsers.find(u => u.email === email);
    
    if (foundUser && password === 'password') {
      setUser(foundUser);
      setIsAuthenticated(true);
      localStorage.setItem('user', JSON.stringify(foundUser));
      return true;
    }
    
    return false;
  };

  const logout = () => {
    setUser(null);
    setIsAuthenticated(false);
    setTwoFactorRequired(false);
    localStorage.removeItem('user');
  };

  return (
    <AuthContext.Provider value={{
      user,
      login,
      logout,
      isAuthenticated,
      twoFactorRequired
    }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};