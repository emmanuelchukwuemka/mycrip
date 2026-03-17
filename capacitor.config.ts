import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'africa.mycrib.app',
  appName: 'MyCrip Africa',
  webDir: 'public',
  plugins: {
    SplashScreen: {
      launchShowDuration: 3000,
      launchAutoHide: true,
      backgroundColor: "#001F3F",
      androidScaleType: "CENTER_CROP",
      showSpinner: true,
      androidSpinnerStyle: "large",
      iosSpinnerStyle: "small",
      spinnerColor: "#C6A664",
      splashFullScreen: true,
      splashImmersive: true,
    },
  },
  server: {
    url: "http://72.62.4.119:8002",
    cleartext: true
  }
};

export default config;
