import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';

class MortgageCalculatorScreen extends StatefulWidget {
  const MortgageCalculatorScreen({super.key});

  @override
  State<MortgageCalculatorScreen> createState() => _MortgageCalculatorScreenState();
}

class _MortgageCalculatorScreenState extends State<MortgageCalculatorScreen> {
  double _propertyPrice = 25000000;
  double _downPayment = 5000000;
  double _interestRate = 18;
  int _loanTerm = 20;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Mortgage Calculator'),
        backgroundColor: AppColors.primaryNavy,
        foregroundColor: Colors.white,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Estimate Your Monthly Payments',
              style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: AppColors.primaryNavy),
            ),
            const SizedBox(height: 24),
            
            _buildSlider('Property Price', _propertyPrice, 5000000, 200000000, (v) => setState(() => _propertyPrice = v), '₦'),
            _buildSlider('Down Payment', _downPayment, 0, _propertyPrice, (v) => setState(() => _downPayment = v), '₦'),
            _buildSlider('Interest Rate', _interestRate, 5, 30, (v) => setState(() => _interestRate = v), '', suffix: '%'),
            _buildSlider('Loan Term', _loanTerm.toDouble(), 1, 30, (v) => setState(() => _loanTerm = v.toInt()), '', suffix: ' Years'),
            
            const SizedBox(height: 40),
            const Text('Result', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 16),
            GlassCard(
              gradient: LinearGradient(
                colors: [AppColors.accentGold.withOpacity(0.1), Colors.white],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
              padding: const EdgeInsets.all(24),
              child: Column(
                children: [
                  const Text('Estimated Monthly Payment', style: TextStyle(color: Colors.grey)),
                  const SizedBox(height: 12),
                  Text(
                    '₦${((_propertyPrice - _downPayment) * (_interestRate / 100 / 12) / (1 - (1 / (1 + (_interestRate / 100 / 12)) * (_loanTerm * 12)))).toInt().toString().replaceAllMapped(RegExp(r'(\d{1,3})(?=(\d{3})+(?!\d))'), (Match m) => '${m[1]},')}',
                    style: const TextStyle(fontSize: 32, fontWeight: FontWeight.bold, color: AppColors.primaryNavy),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSlider(String label, double value, double min, double max, ValueChanged<double> onChanged, String prefix, {String suffix = ''}) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(label, style: const TextStyle(fontWeight: FontWeight.w600)),
            Text('$prefix${value.toInt().toString().replaceAllMapped(RegExp(r'(\d{1,3})(?=(\d{3})+(?!\d))'), (Match m) => '${m[1]},')}$suffix', style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primaryNavy)),
          ],
        ),
        Slider(
          value: value,
          min: min,
          max: max,
          activeColor: AppColors.primaryNavy,
          inactiveColor: AppColors.primaryNavy.withOpacity(0.1),
          onChanged: onChanged,
        ),
        const SizedBox(height: 16),
      ],
    );
  }
}
