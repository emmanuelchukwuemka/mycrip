import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';

class SearchFilterScreen extends StatefulWidget {
  const SearchFilterScreen({super.key});

  @override
  State<SearchFilterScreen> createState() => _SearchFilterScreenState();
}

class _SearchFilterScreenState extends State<SearchFilterScreen> {
  RangeValues _priceRange = const RangeValues(100000, 800000);
  String _selectedCategory = 'Apartments';
  final List<String> _categories = ['Apartments', 'Houses', 'Shops', 'Land', 'Offices'];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Filters'),
        leading: IconButton(
          icon: const Icon(Icons.close_rounded),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text('Category', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 16),
            Wrap(
              spacing: 12,
              runSpacing: 12,
              children: _categories.map((cat) => _buildChoiceChip(cat)).toList(),
            ),
            
            const SizedBox(height: 32),
            const Text('Price Range', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text('\$${_priceRange.start.toInt()}', style: const TextStyle(color: AppColors.accentGold, fontWeight: FontWeight.bold)),
                const Spacer(),
                Text('\$${_priceRange.end.toInt()}', style: const TextStyle(color: AppColors.accentGold, fontWeight: FontWeight.bold)),
              ],
            ),
            RangeSlider(
              values: _priceRange,
              min: 0,
              max: 1000000,
              activeColor: AppColors.primaryNavy,
              inactiveColor: AppColors.primaryNavy.withOpacity(0.1),
              onChanged: (values) {
                setState(() => _priceRange = values);
              },
            ),

            const SizedBox(height: 32),
            const Text('Property Features', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 16),
            _buildFeatureToggle('Swimming Pool', true),
            _buildFeatureToggle('Gym / Fitness Center', false),
            _buildFeatureToggle('Security System', true),
            _buildFeatureToggle('Parking Space', true),
            
            const SizedBox(height: 48),
            SizedBox(
              width: double.infinity,
              height: 56,
              child: ElevatedButton(
                onPressed: () => Navigator.pop(context),
                style: ElevatedButton.styleFrom(
                  backgroundColor: AppColors.primaryNavy,
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                ),
                child: const Text('Apply Filters', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildChoiceChip(String label) {
    final isSelected = _selectedCategory == label;
    return ChoiceChip(
      label: Text(label),
      selected: isSelected,
      onSelected: (selected) {
        setState(() => _selectedCategory = label);
      },
      selectedColor: AppColors.primaryNavy,
      labelStyle: TextStyle(color: isSelected ? Colors.white : AppColors.primaryNavy),
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
        side: BorderSide(color: AppColors.primaryNavy.withOpacity(0.1)),
      ),
    );
  }

  Widget _buildFeatureToggle(String label, bool initialValue) {
    bool value = initialValue;
    return StatefulBuilder(
      builder: (context, setState) {
        return Padding(
          padding: const EdgeInsets.only(bottom: 8.0),
          child: GlassCard(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(label),
                Switch(
                  value: value,
                  activeColor: AppColors.success,
                  onChanged: (v) => setState(() => value = v),
                ),
              ],
            ),
          ),
        );
      }
    );
  }
}
