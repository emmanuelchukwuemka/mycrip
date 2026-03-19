import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../requests/presentation/screens/property_request_board.dart';
import '../../../profile/presentation/screens/profile_screen.dart';
import '../../../chat/presentation/screens/chat_screen.dart';
import '../../../agent/presentation/screens/agent_dashboard.dart';
import '../../../properties/presentation/screens/saved_properties_screen.dart';
import 'home_screen.dart';

class MainScreen extends StatefulWidget {
  const MainScreen({super.key});

  @override
  State<MainScreen> createState() => _MainScreenState();
}

class _MainScreenState extends State<MainScreen> {
  int _currentIndex = 0;

  final List<Widget> _screens = [
    const HomeScreen(),
    const PropertyRequestBoard(),
    const SavedPropertiesScreen(),
    const ChatScreen(),
    const ProfileScreen(),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _screens[_currentIndex],
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _currentIndex,
        onTap: (index) {
          setState(() {
            _currentIndex = index;
          });
        },
        type: BottomNavigationBarType.fixed,
        selectedItemColor: AppColors.primaryNavy,
        unselectedItemColor: Colors.grey,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home_rounded), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.dynamic_feed_rounded), label: 'Requests'),
          BottomNavigationBarItem(icon: Icon(Icons.favorite_rounded), label: 'Saved'),
          BottomNavigationBarItem(icon: Icon(Icons.message_rounded), label: 'Chat'),
          BottomNavigationBarItem(icon: Icon(Icons.person_rounded), label: 'Profile'),
        ],
      ),
      // Adding a FAB to quickly access Agent Dashboard for demo purposes
      floatingActionButton: _currentIndex == 4 ? FloatingActionButton.extended(
        onPressed: () {
          Navigator.push(context, MaterialPageRoute(builder: (context) => const AgentDashboard()));
        },
        backgroundColor: AppColors.primaryNavy,
        label: const Text('Agent Suite', style: TextStyle(color: Colors.white)),
        icon: const Icon(Icons.business_center_rounded, color: Colors.white),
      ) : null,
    );
  }
}
