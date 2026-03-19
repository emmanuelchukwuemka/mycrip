import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';

class PropertyRequestBoard extends StatelessWidget {
  const PropertyRequestBoard({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Buyer Request Wall'),
      ),
      body: ListView(
        padding: const EdgeInsets.all(20),
        children: [
          _buildRequestItem('Looking for 3-Bedroom Apartment in Lagos', 'Max Budget: \$200,000', 'Posted by Emeka • 2h ago'),
          _buildRequestItem('Urgent: Commercial space for tech hub in Accra', 'Budget: \$1,500/mo', 'Posted by Kwame • 5h ago'),
          _buildRequestItem('Need Land in Abuja (with C of O)', 'Area: 1000sqm+', 'Posted by Aisha • 1d ago'),
        ],
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () {},
        backgroundColor: AppColors.primaryNavy,
        icon: const Icon(Icons.add, color: Colors.white),
        label: const Text('Post Request', style: TextStyle(color: Colors.white)),
      ),
    );
  }

  Widget _buildRequestItem(String title, String budget, String meta) {
    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      child: GlassCard(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(title, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Text(budget, style: const TextStyle(color: AppColors.accentGold, fontWeight: FontWeight.w600)),
            const SizedBox(height: 12),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(meta, style: const TextStyle(fontSize: 12, color: Colors.grey)),
                const Text('3 Responses', style: TextStyle(fontSize: 12, color: AppColors.success, fontWeight: FontWeight.bold)),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
