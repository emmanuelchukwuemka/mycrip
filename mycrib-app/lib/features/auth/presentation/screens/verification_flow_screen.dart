import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';

class VerificationFlowScreen extends StatefulWidget {
  const VerificationFlowScreen({super.key});

  @override
  State<VerificationFlowScreen> createState() => _VerificationFlowScreenState();
}

class _VerificationFlowScreenState extends State<VerificationFlowScreen> {
  int _currentStep = 0;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Agent Verification'),
        backgroundColor: AppColors.primaryNavy,
        foregroundColor: Colors.white,
      ),
      body: Stepper(
        type: StepperType.vertical,
        currentStep: _currentStep,
        onStepContinue: () {
          if (_currentStep < 2) {
            setState(() => _currentStep++);
          }
        },
        onStepCancel: () {
          if (_currentStep > 0) {
            setState(() => _currentStep--);
          }
        },
        steps: [
          Step(
            title: const Text('Identity Document'),
            content: Column(
              children: [
                const Text('Provide a valid government-issued ID (Passport, Driver License, or National ID).'),
                const SizedBox(height: 16),
                _buildUploadBox('Upload Front'),
                const SizedBox(height: 12),
                _buildUploadBox('Upload Back'),
              ],
            ),
            isActive: _currentStep >= 0,
          ),
          Step(
            title: const Text('Biometric Verification'),
            content: Column(
              children: [
                const Text('Please take a clear selfie holding your ID next to your face.'),
                const SizedBox(height: 16),
                _buildUploadBox('Open Camera', icon: Icons.camera_alt_rounded),
              ],
            ),
            isActive: _currentStep >= 1,
          ),
          Step(
            title: const Text('Business Verification'),
            content: Column(
              children: [
                const Text('Upload your agency registration documents or professional license.'),
                const SizedBox(height: 16),
                _buildUploadBox('Upload Document', icon: Icons.file_upload_rounded),
              ],
            ),
            isActive: _currentStep >= 2,
          ),
        ],
      ),
    );
  }

  Widget _buildUploadBox(String label, {IconData icon = Icons.cloud_upload_rounded}) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: AppColors.primaryNavy.withOpacity(0.05),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: AppColors.primaryNavy.withOpacity(0.1), style: BorderStyle.solid),
      ),
      child: Column(
        children: [
          Icon(icon, size: 40, color: AppColors.primaryNavy),
          const SizedBox(height: 12),
          Text(label, style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primaryNavy)),
        ],
      ),
    );
  }
}
