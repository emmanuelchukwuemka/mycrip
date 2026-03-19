import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';
import '../../../chat/presentation/screens/chat_screen.dart';

class AgentInquiryInbox extends StatelessWidget {
  const AgentInquiryInbox({super.key});

  @override
  Widget build(BuildContext context) {
    final mockInquiries = [
      {'name': 'John Doe', 'property': 'Luxury Penthouse', 'time': '2 mins ago', 'message': 'Is this still available?', 'status': 'New'},
      {'name': 'Jane Smith', 'property': 'Modern Family Villa', 'time': '1 hour ago', 'message': 'I would like to book a tour for Sunday.', 'status': 'Read'},
      {'name': 'Michael Chen', 'property': 'Commercial Mall', 'time': '5 hours ago', 'message': 'What is the lease duration?', 'status': 'Replied'},
    ];

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Inquiry Inbox', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        foregroundColor: AppColors.primaryNavy,
      ),
      body: ListView.builder(
        padding: const EdgeInsets.all(16),
        itemCount: mockInquiries.length,
        itemBuilder: (context, index) {
          final inquiry = mockInquiries[index];
          final isNew = inquiry['status'] == 'New';

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
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    CircleAvatar(
                      backgroundColor: AppColors.primaryNavy.withOpacity(0.1),
                      child: Text(inquiry['name']!.substring(0, 1), style: const TextStyle(color: AppColors.primaryNavy, fontWeight: FontWeight.bold)),
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Text(inquiry['name']!, style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primaryNavy)),
                              Text(inquiry['time']!, style: const TextStyle(fontSize: 10, color: Colors.grey)),
                            ],
                          ),
                          const SizedBox(height: 4),
                          Text(
                            'Re: ${inquiry['property']}',
                            style: const TextStyle(fontSize: 12, color: AppColors.accentGold, fontWeight: FontWeight.bold),
                          ),
                          const SizedBox(height: 8),
                          Text(
                            inquiry['message']!,
                            style: TextStyle(color: isNew ? AppColors.primaryNavy : Colors.grey, height: 1.4, fontWeight: isNew ? FontWeight.bold : FontWeight.normal),
                            maxLines: 2,
                            overflow: TextOverflow.ellipsis,
                          ),
                        ],
                      ),
                    ),
                    if (isNew)
                      Padding(
                        padding: const EdgeInsets.only(left: 8),
                        child: CircleAvatar(radius: 4, backgroundColor: AppColors.accentGold),
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
