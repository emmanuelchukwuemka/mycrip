import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../core/utils/mock_data.dart';
import '../../../../shared/widgets/glass_card.dart';

class PropertyComparisonScreen extends StatelessWidget {
  final List<Property> properties;

  const PropertyComparisonScreen({super.key, required this.properties});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Compare Properties'),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 20),
            Row(
              children: properties.map((p) => Expanded(
                child: Column(
                  children: [
                    Container(
                      height: 120,
                      margin: const EdgeInsets.symmetric(horizontal: 8),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(12),
                        image: DecorationImage(image: NetworkImage(p.images[0]), fit: BoxFit.cover),
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(p.title, textAlign: TextAlign.center, style: const TextStyle(fontWeight: FontWeight.bold)),
                    Text(p.price, style: const TextStyle(color: AppColors.accentGold, fontSize: 12)),
                  ],
                ),
              )).toList(),
            ),
            const SizedBox(height: 32),
            _buildComparisonRow('Location', properties.map((p) => p.location).toList()),
            _buildComparisonRow('Type', properties.map((p) => p.type).toList()),
            _buildComparisonRow('Bedrooms', properties.map((p) => p.bedrooms.toString()).toList()),
            _buildComparisonRow('Bathrooms', properties.map((p) => p.bathrooms.toString()).toList()),
            _buildComparisonRow('Area', properties.map((p) => '${p.area} m²').toList()),
            const SizedBox(height: 48),
          ],
        ),
      ),
    );
  }

  Widget _buildComparisonRow(String title, List<String> values) {
    return Column(
      children: [
        Container(
          width: double.infinity,
          padding: const EdgeInsets.all(12),
          color: AppColors.primaryNavy.withOpacity(0.05),
          child: Text(title, style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primaryNavy)),
        ),
        Row(
          children: values.map((v) => Expanded(
            child: Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                border: Border(right: BorderSide(color: Colors.white.withOpacity(0.1))),
              ),
              child: Text(v, textAlign: TextAlign.center, style: const TextStyle(fontSize: 13, color: Colors.grey)),
            ),
          )).toList(),
        ),
      ],
    );
  }
}
