import 'package:flutter/material.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../core/utils/mock_data.dart';

class BlogListingScreen extends StatelessWidget {
  const BlogListingScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Real Estate Insights', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.white,
        elevation: 0,
        foregroundColor: AppColors.primaryNavy,
      ),
      body: ListView.builder(
        padding: const EdgeInsets.all(20),
        itemCount: MockData.blogPosts.length,
        itemBuilder: (context, index) {
          final post = MockData.blogPosts[index];
          return Padding(
            padding: const EdgeInsets.only(bottom: 32),
            child: InkWell(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => BlogDetailsScreen(post: post),
                  ),
                );
              },
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      boxShadow: [
                        BoxShadow(
                          color: AppColors.primaryNavy.withOpacity(0.05),
                          blurRadius: 15,
                          offset: const Offset(0, 5),
                        ),
                      ],
                    ),
                    child: ClipRRect(
                      borderRadius: BorderRadius.circular(20),
                      child: Image.network(
                        post['image']!,
                        height: 220,
                        width: double.infinity,
                        fit: BoxFit.cover,
                      ),
                    ),
                  ),
                  const SizedBox(height: 16),
                  Row(
                    children: [
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                        decoration: BoxDecoration(
                          color: AppColors.accentGold.withOpacity(0.1),
                          borderRadius: BorderRadius.circular(6),
                        ),
                        child: Text(
                          post['date']!,
                          style: const TextStyle(color: AppColors.accentGold, fontWeight: FontWeight.bold, fontSize: 10, letterSpacing: 0.5),
                        ),
                      ),
                      const SizedBox(width: 12),
                      const Text('• 5 min read', style: TextStyle(color: Colors.grey, fontSize: 10)),
                    ],
                  ),
                  const SizedBox(height: 12),
                  Text(
                    post['title']!,
                    style: const TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: AppColors.primaryNavy),
                  ),
                  const SizedBox(height: 12),
                  Text(
                    post['excerpt']!,
                    style: const TextStyle(color: Colors.grey, height: 1.5, fontSize: 14),
                    maxLines: 3,
                    overflow: TextOverflow.ellipsis,
                  ),
                  const SizedBox(height: 16),
                  const Row(
                    children: [
                      Text(
                        'Read Full Article',
                        style: TextStyle(color: AppColors.primaryNavy, fontWeight: FontWeight.bold, fontSize: 13),
                      ),
                      SizedBox(width: 4),
                      Icon(Icons.arrow_forward_rounded, color: AppColors.primaryNavy, size: 16),
                    ],
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}

class BlogDetailsScreen extends StatelessWidget {
  final Map<String, String> post;

  const BlogDetailsScreen({super.key, required this.post});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: CustomScrollView(
        slivers: [
          SliverAppBar(
            expandedHeight: 300,
            pinned: true,
            flexibleSpace: FlexibleSpaceBar(
              background: Image.network(
                post['image']!,
                fit: BoxFit.cover,
              ),
            ),
          ),
          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.all(24),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    post['date']!.toUpperCase(),
                    style: const TextStyle(color: AppColors.accentGold, fontWeight: FontWeight.bold, letterSpacing: 2, fontSize: 12),
                  ),
                  const SizedBox(height: 16),
                  Text(
                    post['title']!,
                    style: const TextStyle(fontSize: 28, fontWeight: FontWeight.bold, color: AppColors.primaryNavy, height: 1.2),
                  ),
                  const SizedBox(height: 24),
                  const Divider(),
                  const SizedBox(height: 24),
                  const Text(
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n\n'
                    'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n'
                    'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
                    style: TextStyle(fontSize: 16, height: 1.8, color: Colors.black87),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
