import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';

class NotificationsSettingsScreen extends StatefulWidget {
  const NotificationsSettingsScreen({super.key});

  @override
  State<NotificationsSettingsScreen> createState() => _NotificationsSettingsScreenState();
}

class _NotificationsSettingsScreenState extends State<NotificationsSettingsScreen> {
  bool _priceDrops = true;
  bool _newInquiries = true;
  bool _tourReminders = true;
  bool _marketingNews = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Notifications', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        foregroundColor: AppColors.primaryNavy,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Notification Preferences',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: AppColors.primaryNavy),
            ),
            const SizedBox(height: 8),
            const Text(
              'Choose what alerts you want to receive in real-time.',
              style: TextStyle(color: Colors.grey),
            ),
            const SizedBox(height: 32),
            
            _buildSettingTile(
              'Price Drops',
              'Get notified when your saved properties drop in price.',
              Icons.trending_down_rounded,
              _priceDrops,
              (val) => setState(() => _priceDrops = val),
            ),
            _buildSettingTile(
              'New Inquiries',
              'Instant alerts when a buyer sends a message or takes interest.',
              Icons.chat_bubble_outline_rounded,
              _newInquiries,
              (val) => setState(() => _newInquiries = val),
            ),
            _buildSettingTile(
              'Tour Reminders',
              'Stay updated on your upcoming property viewings.',
              Icons.calendar_today_rounded,
              _tourReminders,
              (val) => setState(() => _tourReminders = val),
            ),
            _buildSettingTile(
              'Marketing & News',
              'Updates on new features and real estate trends.',
              Icons.campaign_outlined,
              _marketingNews,
              (val) => setState(() => _marketingNews = val),
            ),
            
            const SizedBox(height: 40),
            GlassCard(
              padding: const EdgeInsets.all(20),
              child: Column(
                children: [
                  const Icon(Icons.notifications_active_rounded, color: AppColors.accentGold, size: 40),
                  const SizedBox(height: 16),
                  const Text(
                    'Smart Notification Quiet Time',
                    style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                  ),
                  const Text(
                    'Mute all alerts automatically between 10 PM and 7 AM.',
                    textAlign: TextAlign.center,
                    style: TextStyle(color: Colors.grey, fontSize: 13),
                  ),
                  const SizedBox(height: 16),
                  SwitchListTile(
                    value: false,
                    onChanged: (val) {},
                    title: const Text('Enable Quiet Time', style: TextStyle(fontWeight: FontWeight.bold, fontSize: 14)),
                    activeColor: AppColors.primaryNavy,
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSettingTile(String title, String subtitle, IconData icon, bool value, Function(bool) onChanged) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: GlassCard(
        padding: const EdgeInsets.all(16),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(color: AppColors.primaryNavy.withOpacity(0.05), borderRadius: BorderRadius.circular(10)),
              child: Icon(icon, color: AppColors.primaryNavy),
            ),
            const SizedBox(width: 16),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(title, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
                  Text(subtitle, style: const TextStyle(color: Colors.grey, fontSize: 12)),
                ],
              ),
            ),
            Switch(
              value: value,
              onChanged: onChanged,
              activeColor: AppColors.accentGold,
              activeTrackColor: AppColors.primaryNavy.withOpacity(0.1),
            ),
          ],
        ),
      ),
    );
  }
}
