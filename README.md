# YB Selected Posts

A WordPress Gutenberg block for adding links to published posts.

## Features

- 🎯 **Easy Post Selection** - Choose from your published posts with an intuitive interface
- 🎨 **Gutenberg Integration** - Native block editor support
- 📱 **Responsive Design** - Works perfectly on all devices
- ⚡ **Performance Optimized** - Lightweight and fast

## Installation

### From GitHub Releases (Recommended)

1. Go to the [Releases page](https://github.com/your-username/yb-selected-posts/releases)
2. Download the latest `yb-selected-posts-v*.zip` file
3. In your WordPress admin, go to **Plugins → Add New → Upload Plugin**
4. Upload the zip file and activate

### Manual Installation

1. Download or clone this repository
2. Run the build process:
   ```bash
   npm install
   npm run dist
   ```
3. Upload the generated `yb-selected-posts.zip` to WordPress

## Development

### Prerequisites

- Node.js 16+ and npm
- PHP 7.4+ with Composer
- WordPress development environment

### Setup

```bash
# Clone the repository
git clone https://github.com/your-username/yb-selected-posts.git
cd yb-selected-posts

# Install dependencies
npm install
composer install

# Start development server
npm start
```

### Building for Production

```bash
# Create distribution-ready zip
npm run dist

# Clean build (removes node_modules first)
npm run dist:clean
```

### Development Commands

```bash
npm start          # Start development server with hot reload
npm run build      # Build production assets
npm run lint:js    # Lint JavaScript files
npm run lint:css   # Lint CSS/SCSS files
npm run format     # Format code with Prettier
```

## Release Process

This project uses automated releases via GitHub Actions:

1. **Manual Release**: Go to Actions → "Prepare Release" → Run workflow
2. **Automatic Release**: Push a version tag (e.g., `v1.2.3`)

The release process automatically:
- ✅ Builds production assets
- ✅ Installs production dependencies
- ✅ Creates plugin zip file
- ✅ Publishes GitHub release
- ✅ Updates changelog

## Plugin Structure

```
yb-selected-posts/
├── src/                 # Source files (development)
│   ├── block.json      # Block configuration
│   ├── edit.js         # Block editor component
│   ├── save.js         # Block save component
│   └── style.scss      # Block styles
├── build/              # Built assets (production)
├── includes/           # PHP classes
├── vendor/             # Composer dependencies
├── .github/            # GitHub Actions workflows
└── yb-selected-posts.php # Main plugin file
```

## Requirements

- WordPress 6.5+
- PHP 7.4+

## License

GPL-2.0-or-later

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Support

If you encounter any issues or have questions:

1. Check the [documentation](https://github.com/your-username/yb-selected-posts/wiki)
2. Search [existing issues](https://github.com/your-username/yb-selected-posts/issues)
3. Create a [new issue](https://github.com/your-username/yb-selected-posts/issues/new) if needed

---

Made with ❤️ by [Yorick Brown](https://theyoricktouch.co.uk)
