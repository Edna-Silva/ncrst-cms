export interface User {
  id: string;
  username: string;
  email: string;
  role: 'ccm_admin' | 'editor' | 'checker';
  department?: string;
  isActive: boolean;
  lastLogin?: Date;
  createdAt: Date;
}

export interface Department {
  id: string;
  name: string;
  fullName: string;
  description: string;
  isActive: boolean;
  createdAt: Date;
  updatedAt: Date;
  editorCount: number;
}

export interface PendingChange {
  id: string;
  editorId: string;
  editorName: string;
  departmentId: string;
  departmentName: string;
  changeType: 'create' | 'update' | 'delete';
  content: any;
  originalContent?: any;
  status: 'pending_checker' | 'pending_admin' | 'approved' | 'rejected' | 'sent_back';
  checkerNotes?: string;
  adminNotes?: string;
  createdAt: Date;
  reviewedAt?: Date;
  approvedAt?: Date;
  checkedBy?: string;
  approvedBy?: string;
}

export interface AuthContextType {
  user: User | null;
  login: (email: string, password: string, twoFactorCode?: string) => Promise<boolean>;
  logout: () => void;
  isAuthenticated: boolean;
  twoFactorRequired: boolean;
}

export interface DashboardStats {
  totalUsers: number;
  totalDepartments: number;
  pendingChanges: number;
  approvedChanges: number;
}