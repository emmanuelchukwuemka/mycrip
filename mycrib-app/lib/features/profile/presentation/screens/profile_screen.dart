import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';
import '../../../inquiries/presentation/screens/my_inquiries_screen.dart';
import '../../../properties/presentation/screens/saved_properties_screen.dart';
import '../../../support/presentation/screens/support_center_screen.dart';
import '../../../auth/presentation/screens/verification_flow_screen.dart';
import '../../../notifications/presentation/screens/notifications_settings_screen.dart';
import '../../../auth/presentation/screens/biometric_setup_screen.dart';

class ProfileScreen extends StatelessWidget {
  const ProfileScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('My Profile'),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24),
        child: Column(
          children: [
            const CircleAvatar(
              radius: 50,
              backgroundImage: NetworkImage('https://i.pravatar.cc/150?u=user'),
            ),
            const SizedBox(height: 16),
            const Text('Oluwaseun Adeyemi', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold)),
            const Text('Customer Account', style: TextStyle(color: Colors.grey)),
            const SizedBox(height: 32),
            
            InkWell(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => const SavedPropertiesScreen()),
                );
              },
              child: _buildProfileOption(Icons.favorite_rounded, 'Saved Properties'),
            ),
            InkWell(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => MyInquiriesScreen()),
                );
              },
              child: _buildProfileOption(Icons.description_outlined, 'My Inquiries'),
            ),
            _buildProfileOption(Icons.history_rounded, 'Recent Activities'),
            InkWell(
              onTap: () {
                Navigator.push(context, MaterialPageRoute(builder: (context) => VerificationFlowScreen()));
              },
              child: _buildProfileOption(Icons.verified_user_rounded, 'Verification Status', subtitle: 'Verified'),
            ),
            InkWell(
              onTap: () {
                Navigator.push(context, MaterialPageRoute(builder: (context) => BiometricSetupScreen()));
              },
              child: _buildProfileOption(Icons.security_rounded, 'Account Security'),
            ),
            InkWell(
              onTap: () {
                Navigator.push(context, MaterialPageRoute(builder: (context) => NotificationsSettingsScreen()));
              },
              child: _buildProfileOption(Icons.help_outline_rounded, 'Support & FAQ'),
            ),
            const SizedBox(height: 32),
            InkWell(
              onTap: () {
                showDialog(
                  context: context,
                  builder: (context) => AlertDialog(
                    title: const Text('Logout'),
                    content: const Text('Are you sure you want to logout?'),
                    actions: [
                      TextButton(onPressed: () => Navigator.pop(context), child: const Text('Cancel')),
                      TextButton(
                        onPressed: () {
                          // In a real app, clear session and navigate to login
                          Navigator.pop(context);
                          ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Logged out successfully')));
                        },
                        child: const Text('Logout', style: TextStyle(color: AppColors.error)),
                      ),
                    ],
                  ),
                );
              },
              child: Container(
                padding: const EdgeInsets.symmetric(vertical: 16),
                decoration: BoxDecoration(
                  color: AppColors.error.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(16),
                  border: Border.all(color: AppColors.error.withOpacity(0.2)),
                ),
                child: const Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(Icons.logout_rounded, color: AppColors.error),
                    SizedBox(width: 8),
                    Text(
                      'Logout',
                      style: TextStyle(color: AppColors.error, fontWeight: FontWeight.bold, fontSize: 16),
                    ),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 40),
          ],
        ),
      ),
    );
  }

  Widget _buildProfileOption(IconData icon, String title, {String? subtitle}) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      child: GlassCard(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
        child: Row(
          children: [
            Icon(icon, color: AppColors.primaryNavy, size: 24),
            const SizedBox(width: 16),
            Expanded(child: Text(title, style: const TextStyle(fontWeight: FontWeight.w600))),
            if (subtitle != null) Text(subtitle, style: const TextStyle(color: AppColors.success, fontSize: 12, fontWeight: FontWeight.bold)),
            const Icon(Icons.chevron_right_rounded, color: Colors.grey),
          ],
        ),
      ),
    );
  }
}
