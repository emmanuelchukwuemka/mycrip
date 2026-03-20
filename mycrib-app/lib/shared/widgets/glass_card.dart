import 'dart:ui';
import 'package:flutter/material.dart';

class GlassCard extends StatelessWidget {
  final Widget child;
  final double? height;
  final double? width;
  final BorderRadius? borderRadius;
  final double? blur;
  final EdgeInsetsGeometry? padding;
  final Gradient? gradient;

  const GlassCard({
    super.key,
    required this.child,
    this.height,
    this.width,
    this.borderRadius,
    this.blur,
    this.padding,
    this.gradient,
  });

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final radius = borderRadius ?? BorderRadius.circular(20);

    return ClipRRect(
      borderRadius: radius,
      child: Container(
        height: height,
        width: width,
        child: Stack(
          children: [
            // Blur Effect
            BackdropFilter(
              filter: ImageFilter.blur(
                sigmaX: blur ?? 15,
                sigmaY: blur ?? 15,
              ),
              child: Container(),
            ),
            
            // Gradient Overlay
            Container(
              padding: padding,
              decoration: BoxDecoration(
                borderRadius: radius,
                border: Border.all(
                  color: Colors.white.withOpacity(0.2),
                  width: 1.5,
                ),
                gradient: gradient ?? LinearGradient(
                  colors: [
                    Colors.white.withOpacity(0.2),
                    Colors.white.withOpacity(0.1),
                  ],
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                ),
              ),
              child: child,
            ),
          ],
        ),
      ),
    );
  }
}
