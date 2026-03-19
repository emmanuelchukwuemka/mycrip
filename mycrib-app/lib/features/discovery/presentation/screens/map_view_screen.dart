import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../shared/widgets/glass_card.dart';
import '../../../properties/presentation/screens/property_details_screen.dart';

class MapSearchScreen extends StatefulWidget {
  const MapSearchScreen({super.key});

  @override
  State<MapSearchScreen> createState() => _MapSearchScreenState();
}

class _MapSearchScreenState extends State<MapSearchScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          // Mock Map Background
          Container(
            color: Colors.blueGrey[100],
            child: Center(
              child: Stack(
                children: [
                  // Mock Map Texture/Lines
                  CustomPaint(
                    size: Size.infinite,
                    painter: MapPainter(),
                  ),
                  // Mock Property Pins
                  _buildMapPin(context, 100, 200, '\$450k'),
                  _buildMapPin(context, 250, 150, '\$320k'),
                  _buildMapPin(context, 180, 400, '\$1.2M'),
                  _buildMapPin(context, 320, 550, '\$85k'),
                ],
              ),
            ),
          ),

          // Search Header
          SafeArea(
            child: Padding(
              padding: const EdgeInsets.all(16),
              child: Column(
                children: [
                  GlassCard(
                    padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                    child: Row(
                      children: [
                        IconButton(
                          icon: const Icon(Icons.arrow_back),
                          onPressed: () => Navigator.pop(context),
                        ),
                        const Expanded(
                          child: TextField(
                            decoration: InputDecoration(
                              hintText: 'Search Lagos, Nigeria...',
                              border: InputBorder.none,
                            ),
                          ),
                        ),
                        const Icon(Icons.tune_rounded, color: AppColors.primaryNavy),
                      ],
                    ),
                  ),
                  const SizedBox(height: 12),
                  SingleChildScrollView(
                    scrollDirection: Axis.horizontal,
                    child: Row(
                      children: [
                        _buildFilterChip('Apartment', true),
                        _buildFilterChip('Price', false),
                        _buildFilterChip('Bedrooms', false),
                        _buildFilterChip('More', false),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),

          // Bottom Preview Card
          Positioned(
            bottom: 40,
            left: 0,
            right: 0,
            child: SizedBox(
              height: 140,
              child: PageView.builder(
                controller: PageController(viewportFraction: 0.85),
                itemCount: 3,
                itemBuilder: (context, index) {
                  return Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 8),
                    child: InkWell(
                      onTap: () {
                        // Navigate to details (mock)
                      },
                      child: GlassCard(
                        padding: const EdgeInsets.all(12),
                        child: Row(
                          children: [
                            Container(
                              width: 100,
                              height: 100,
                              decoration: BoxDecoration(
                                color: AppColors.primaryNavy.withOpacity(0.1),
                                borderRadius: BorderRadius.circular(12),
                                image: const DecorationImage(
                                  image: NetworkImage('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=200&q=80'),
                                  fit: BoxFit.cover,
                                ),
                              ),
                            ),
                            const SizedBox(width: 16),
                            Expanded(
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  const Text(
                                    'Luxury Apartment',
                                    style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                                  ),
                                  const Text(
                                    'Lekki Phase 1, Lagos',
                                    style: TextStyle(fontSize: 12, color: Colors.grey),
                                  ),
                                  const Spacer(),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                    children: [
                                      const Text(
                                        '\$450,000',
                                        style: TextStyle(fontWeight: FontWeight.bold, color: AppColors.accentGold),
                                      ),
                                      Container(
                                        padding: const EdgeInsets.all(4),
                                        decoration: BoxDecoration(
                                          color: AppColors.primaryNavy,
                                          borderRadius: BorderRadius.circular(8),
                                        ),
                                        child: const Icon(Icons.arrow_forward_ios_rounded, size: 12, color: Colors.white),
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  );
                },
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildMapPin(BuildContext context, double x, double y, String label) {
    return Positioned(
      left: x,
      top: y,
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
            decoration: BoxDecoration(
              color: AppColors.primaryNavy,
              borderRadius: BorderRadius.circular(20),
              boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.2), blurRadius: 4)],
            ),
            child: Text(
              label,
              style: const TextStyle(color: Colors.white, fontSize: 10, fontWeight: FontWeight.bold),
            ),
          ),
          const Icon(Icons.arrow_drop_down, color: AppColors.primaryNavy, size: 24),
        ],
      ),
    );
  }

  Widget _buildFilterChip(String label, bool isSelected) {
    return Container(
      margin: const EdgeInsets.only(right: 8),
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      decoration: BoxDecoration(
        color: isSelected ? AppColors.primaryNavy : Colors.white.withOpacity(0.8),
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: isSelected ? AppColors.primaryNavy : Colors.white),
      ),
      child: Text(
        label,
        style: TextStyle(
          color: isSelected ? Colors.white : AppColors.primaryNavy,
          fontWeight: FontWeight.bold,
          fontSize: 12,
        ),
      ),
    );
  }
}

class MapPainter extends CustomPainter {
  @override
  void paint(Canvas canvas, Size size) {
    final paint = Paint()
      ..color = Colors.white.withOpacity(0.5)
      ..strokeWidth = 2;

    // Draw some random "streets"
    canvas.drawLine(const Offset(0, 300), Offset(size.width, 350), paint);
    canvas.drawLine(const Offset(200, 0), Offset(180, size.height), paint);
    canvas.drawLine(const Offset(500, 200), Offset(0, 600), paint);
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => false;
}
