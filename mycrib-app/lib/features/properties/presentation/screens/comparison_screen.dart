import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';

class ComparisonScreen extends StatelessWidget {
  const ComparisonScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Compare Properties', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        foregroundColor: AppColors.primaryNavy,
      ),
      body: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(24),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  const SizedBox(width: 120), // Attribute label column
                  _buildPropertyHeader('Luxury Penthouse', 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=200'),
                  const SizedBox(width: 24),
                  _buildPropertyHeader('Modern Villa', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=200'),
                ],
              ),
              const SizedBox(height: 32),
              _buildCompareRow('Price', '\$450,000', '\$320,000'),
              _buildCompareRow('Type', 'Apartment', 'Villa'),
              _buildCompareRow('Size', '2,400 sqft', '3,100 sqft'),
              _buildCompareRow('Bedrooms', '3', '4'),
              _buildCompareRow('Bathrooms', '2.5', '3'),
              _buildCompareRow('Parking', '2 Slots', '3 Slots'),
              _buildCompareRow('Land Title', 'C of O', 'Governor Consent'),
              _buildCompareRow('Furnished', 'Fully', 'Semi'),
              const SizedBox(height: 40),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildPropertyHeader(String title, String imageUrl) {
    return SizedBox(
      width: 180,
      child: Column(
        children: [
          Container(
            height: 120,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(16),
              image: DecorationImage(image: NetworkImage(imageUrl), fit: BoxFit.cover),
            ),
          ),
          const SizedBox(height: 12),
          Text(title, style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primaryNavy), textAlign: TextAlign.center),
        ],
      ),
    );
  }

  Widget _buildCompareRow(String label, String value1, String value2) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: Row(
        children: [
          SizedBox(
            width: 120,
            child: Text(label, style: const TextStyle(color: Colors.grey, fontWeight: FontWeight.w500)),
          ),
          _buildValueCell(value1),
          const SizedBox(width: 24),
          _buildValueCell(value2),
        ],
      ),
    );
  }

  Widget _buildValueCell(String value) {
    return Container(
      width: 180,
      padding: const EdgeInsets.symmetric(vertical: 12),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: AppColors.primaryNavy.withOpacity(0.05)),
      ),
      child: Center(
        child: Text(value, style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primaryNavy)),
      ),
    );
  }
}
