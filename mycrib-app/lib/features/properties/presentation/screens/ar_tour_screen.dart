import 'package:flutter/material.dart';
import 'dart:math' as math;
import '../../../../core/constants/app_colors.dart';

class ARTourScreen extends StatefulWidget {
  const ARTourScreen({super.key});

  @override
  State<ARTourScreen> createState() => _ARTourScreenState();
}

class _ARTourScreenState extends State<ARTourScreen> {
  double _horizontalOffset = 0.0;
  double _verticalOffset = 0.0;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black,
      body: Stack(
        children: [
          // Immersive 360 Canvas
          GestureDetector(
            onPanUpdate: (details) {
              setState(() {
                _horizontalOffset += details.delta.dx * 0.005;
                _verticalOffset = (_verticalOffset + details.delta.dy * 0.005).clamp(-0.5, 0.5);
              });
            },
            child: CustomPaint(
              size: Size.infinite,
              painter: PanoramaPainter(_horizontalOffset, _verticalOffset),
            ),
          ),

          // Overlay UI
          SafeArea(
            child: Padding(
              padding: const EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      IconButton(
                        icon: const Icon(Icons.close_rounded, color: Colors.white, size: 32),
                        onPressed: () => Navigator.pop(context),
                      ),
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                        decoration: BoxDecoration(
                          color: Colors.black54,
                          borderRadius: BorderRadius.circular(20),
                          border: Border.all(color: Colors.white24),
                        ),
                        child: const Row(
                          children: [
                            Icon(Icons.view_in_ar_rounded, color: AppColors.accentGold, size: 16),
                            SizedBox(width: 8),
                            Text('AR MODE ACTIVE', style: TextStyle(color: Colors.white, fontSize: 10, fontWeight: FontWeight.bold)),
                          ],
                        ),
                      ),
                    ],
                  ),
                  const Spacer(),
                  const Text(
                    'Master Bedroom',
                    style: TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold),
                  ),
                  const Text(
                    'Drag to look around • Tap hotspots to move',
                    style: TextStyle(color: Colors.white70, fontSize: 14),
                  ),
                  const SizedBox(height: 24),

                  // AR Tools
                  Row(
                    children: [
                      _buildARToolButton(Icons.chair_alt_rounded, 'Place Furniture'),
                      const SizedBox(width: 12),
                      _buildARToolButton(Icons.color_lens_rounded, 'Wall Paint'),
                    ],
                  ),
                  const SizedBox(height: 24),
                  
                  // Navigation Hotspots Mini-Map (Mock)
                  Row(
                    children: [
                      _buildHotspotPreview('Living Room', true),
                      const SizedBox(width: 12),
                      _buildHotspotPreview('Kitchen', false),
                      const SizedBox(width: 12),
                      _buildHotspotPreview('Balcony', false),
                    ],
                  ),
                  const SizedBox(height: 20),
                ],
              ),
            ),
          ),
          
          // Center Reticle
          Center(
            child: Container(
              width: 4,
              height: 4,
              decoration: const BoxDecoration(color: Colors.white54, shape: BoxShape.circle),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildHotspotPreview(String label, bool isActive) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
      decoration: BoxDecoration(
        color: isActive ? AppColors.accentGold : Colors.white10,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: isActive ? AppColors.accentGold : Colors.white24),
      ),
      child: Text(
        label,
        style: TextStyle(
          color: isActive ? AppColors.primaryNavy : Colors.white,
          fontWeight: FontWeight.bold,
          fontSize: 12,
        ),
      ),
    );
  }

  Widget _buildARToolButton(IconData icon, String label) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
      decoration: BoxDecoration(
        color: AppColors.primaryNavy.withOpacity(0.8),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.white24),
      ),
      child: Row(
        children: [
          Icon(icon, color: Colors.white, size: 18),
          const SizedBox(width: 8),
          Text(label, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 12)),
        ],
      ),
    );
  }
}

class PanoramaPainter extends CustomPainter {
  final double horizontalRotation;
  final double verticalRotation;

  PanoramaPainter(this.horizontalRotation, this.verticalRotation);

  @override
  void paint(Canvas canvas, Size size) {
    final center = Offset(size.width / 2, size.height / 2);
    final paint = Paint()
      ..strokeWidth = 1.0
      ..style = PaintingStyle.stroke;

    // Draw some "wireframe" room elements to simulate perspective
    for (int i = 0; i < 8; i++) {
      final angle = (i * math.pi / 4) + horizontalRotation;
      final x = center.dx + math.cos(angle) * 300;
      final y = center.dy + math.sin(verticalRotation) * 200;

      // Vertical pillars
      paint.color = Colors.white.withOpacity(0.1);
      canvas.drawLine(Offset(x, 0), Offset(x, size.height), paint);

      // Floor/Ceiling lines
      paint.color = Colors.white.withOpacity(0.05);
      canvas.drawLine(center, Offset(x, y), paint);
    }

    // Draw "Hotspot" icons
    _drawHotspot(canvas, center, horizontalRotation + 1.0, verticalRotation + 0.2, 'Window');
    _drawHotspot(canvas, center, horizontalRotation - 0.5, verticalRotation - 0.3, 'Closet');
  }

  void _drawHotspot(Canvas canvas, Offset center, double angle, double vShift, String label) {
    final x = center.dx + math.cos(angle) * 400;
    final y = center.dy + math.sin(vShift) * 300;

    final paint = Paint()
      ..color = AppColors.accentGold.withOpacity(0.3)
      ..style = PaintingStyle.fill;
    
    canvas.drawCircle(Offset(x, y), 20, paint);
    
    final borderPaint = Paint()
      ..color = AppColors.accentGold
      ..style = PaintingStyle.stroke
      ..strokeWidth = 2;
    canvas.drawCircle(Offset(x, y), 20, borderPaint);

    final textPainter = TextPainter(
      text: TextSpan(
        text: label,
        style: const TextStyle(color: Colors.white, fontSize: 12, fontWeight: FontWeight.bold),
      ),
      textDirection: TextDirection.ltr,
    )..layout();
    
    textPainter.paint(canvas, Offset(x - textPainter.width / 2, y + 25));
  }

  @override
  bool shouldRepaint(PanoramaPainter oldDelegate) => 
    oldDelegate.horizontalRotation != horizontalRotation || 
    oldDelegate.verticalRotation != verticalRotation;
}
