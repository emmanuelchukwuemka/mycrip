class Property {
  final String id;
  final String title;
  final String location;
  final String price;
  final String description;
  final List<String> images;
  final String type;
  final int bedrooms;
  final int bathrooms;
  final double area;
  final String agentName;
  final String agentImage;

  Property({
    required this.id,
    required this.title,
    required this.location,
    required this.price,
    required this.description,
    required this.images,
    required this.type,
    required this.bedrooms,
    required this.bathrooms,
    required this.area,
    required this.agentName,
    required this.agentImage,
  });
}

class MockData {
  static List<String> categories = [
    'Apartments',
    'Houses',
    'Land',
    'Shops',
    'Warehouses',
    'Hotels',
    'Lodges',
  ];

  static List<Property> properties = [
    Property(
      id: '1',
      title: 'Luxury Penthouse',
      location: 'Victoria Island, Lagos',
      price: '₦450,000,000',
      description: 'Experience unparalleled luxury in this stunning penthouse with panoramic views of the Atlantic Ocean. Features include automated smart home systems, a private infinity pool, and world-class interior design.',
      images: [
        'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80',
      ],
      type: 'Apartment',
      bedrooms: 4,
      bathrooms: 5,
      area: 350.5,
      agentName: 'Sarah Johnson',
      agentImage: 'https://i.pravatar.cc/150?u=sarah',
    ),
    Property(
      id: '2',
      title: 'Modern Family Villa',
      location: 'East Legon, Accra',
      price: '₦320,000,000',
      description: 'A contemporary family home designed for comfort and elegance. Located in a secure gated community, this villa offers spacious gardens, a modern kitchen, and high-end finishes throughout.',
      images: [
        'https://images.unsplash.com/photo-1600585154340-be6199f7e009?auto=format&fit=crop&w=800&q=80',
      ],
      type: 'House',
      bedrooms: 5,
      bathrooms: 4,
      area: 420.0,
      agentName: 'John Boateng',
      agentImage: 'https://i.pravatar.cc/150?u=john',
    ),
    Property(
      id: '3',
      title: 'Commercial Land Space',
      location: 'Ikeja, Lagos',
      price: '₦150,000,000',
      description: 'Prime commercial land located in the heart of Ikeja. Perfect for office complex or shopping mall development. Road accessible and secure title documents.',
      images: [
        'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=800&q=80',
      ],
      type: 'Land',
      bedrooms: 0,
      bathrooms: 0,
      area: 1200.0,
      agentName: 'Michael Chen',
      agentImage: 'https://i.pravatar.cc/150?u=michael',
    ),
    Property(
      id: '4',
      title: 'Beachside Lodge',
      location: 'Zanzibar, Tanzania',
      price: '₦85,000,000',
      description: 'A beautiful beachside lodge perfect for vacation or short-let investment. Fully furnished with traditional African decor and modern amenities.',
      images: [
        'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?auto=format&fit=crop&w=800&q=80',
      ],
      type: 'Lodge',
      bedrooms: 2,
      bathrooms: 2,
      area: 120.0,
      agentName: 'Fatuma Salim',
      agentImage: 'https://i.pravatar.cc/150?u=fatuma',
    ),
  ];

  static List<Map<String, String>> blogPosts = [
    {
      'id': '1',
      'title': 'The Rise of Smart Homes in Africa',
      'excerpt': 'How technology is reshaping the residential landscape in major African cities.',
      'image': 'https://images.unsplash.com/photo-1558002038-103792e073dc?auto=format&fit=crop&w=800&q=80',
      'date': 'Oct 12, 2025',
    },
    {
      'id': '2',
      'title': 'Investing in Land: Lagos vs. Accra',
      'excerpt': 'A comprehensive comparison for real estate investors looking at West Africa.',
      'image': 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=800&q=80',
      'date': 'Oct 15, 2025',
    },
  ];
}
