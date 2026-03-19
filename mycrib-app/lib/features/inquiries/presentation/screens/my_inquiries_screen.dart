import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';
import '../../../chat/presentation/screens/chat_screen.dart';

class MyInquiriesScreen extends StatelessWidget {
  const MyInquiriesScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final mockInquiries = [
      {'title': 'Luxury Penthouse', 'status': 'Pending', 'date': 'Oct 18, 2025'},
      {'title': 'Modern Family Villa', 'status': 'Replied', 'date': 'Oct 15, 2025'},
    ];

    return Scaffold(
      appBar: AppBar(
        title: const Text('My Inquiries', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        foregroundColor: AppColors.primaryNavy,
      ),
      body: ListView.builder(
        padding: const EdgeInsets.all(16),
        itemCount: mockInquiries.length,
        itemBuilder: (context, index) {
          final inquiry = mockInquiries[index];
          final isReplied = inquiry['status'] == 'Replied';

          return Padding(
            padding: const EdgeInsets.only(bottom: 16),
            child: InkWell(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => ChatScreen()),
                );
              },
              child: GlassCard(
                padding: const EdgeInsets.all(16),
                child: Row(
                  children: [
                    Container(
                      width: 50,
                      height: 50,
                      decoration: BoxDecoration(
                        color: AppColors.primaryNavy.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: const Icon(Icons.description_outlined, color: AppColors.primaryNavy),
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(inquiry['title']!, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16, color: AppColors.primaryNavy)),
                          const SizedBox(height: 4),
                          Text('Sent on ${inquiry['date']}', style: const TextStyle(color: Colors.grey, fontSize: 12)),
                        ],
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                      decoration: BoxDecoration(
                        color: isReplied ? Colors.green.withOpacity(0.1) : Colors.orange.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Text(
                        inquiry['status']!,
                        style: TextStyle(
                          color: isReplied ? Colors.green : Colors.orange,
                          fontWeight: FontWeight.bold,
                          fontSize: 12,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          );
        },
      ),
    );
  }
}
