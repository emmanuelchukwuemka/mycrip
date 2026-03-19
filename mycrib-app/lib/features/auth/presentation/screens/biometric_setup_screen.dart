import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';

class BiometricSetupScreen extends StatefulWidget {
  const BiometricSetupScreen({super.key});

  @override
  State<BiometricSetupScreen> createState() => _BiometricSetupScreenState();
}

class _BiometricSetupScreenState extends State<BiometricSetupScreen> {
  bool _isEnrolled = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Security', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.transparent,
        elevation: 0,
        foregroundColor: AppColors.primaryNavy,
      ),
      body: Padding(
        padding: const EdgeInsets.all(32),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(Icons.fingerprint_rounded, size: 100, color: AppColors.primaryNavy),
            const SizedBox(height: 40),
            const Text(
              'Biometric Login',
              style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold, color: AppColors.primaryNavy),
            ),
            const SizedBox(height: 16),
            const Text(
              'Enable FaceID or Fingerprint for faster and more secure access to your MyCrib Africa account.',
              textAlign: TextAlign.center,
              style: TextStyle(color: Colors.grey, height: 1.5),
            ),
            const SizedBox(height: 48),
            
            if (!_isEnrolled) ...[
              ElevatedButton(
                onPressed: () {
                  // Simulate Enrollment
                  setState(() => _isEnrolled = true);
                  ScaffoldMessenger.of(context).showSnackBar(
                    const SnackBar(content: Text('Biometrics enrolled successfully!')),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: AppColors.primaryNavy,
                  foregroundColor: Colors.white,
                  minimumSize: const Size(double.infinity, 56),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                ),
                child: const Text('Setup Biometrics', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              ),
            ] else ...[
              GlassCard(
                padding: const EdgeInsets.all(20),
                child: Row(
                  children: [
                    const Icon(Icons.check_circle_rounded, color: AppColors.success),
                    const SizedBox(width: 16),
                    const Expanded(
                      child: Text(
                        'Biometric login is enabled',
                        style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                      ),
                    ),
                    TextButton(
                      onPressed: () => setState(() => _isEnrolled = false),
                      child: const Text('Disable', style: TextStyle(color: AppColors.error)),
                    ),
                  ],
                ),
              ),
            ],
            
            const SizedBox(height: 24),
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text('Maybe Later', style: TextStyle(color: Colors.grey)),
            ),
          ],
        ),
      ),
    );
  }
}
