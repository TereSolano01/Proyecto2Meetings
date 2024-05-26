// vite.config.js
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: 'dist', // Especifica el directorio de salida
    assetsDir: '', // Especifica el directorio de assets
    manifest: true, // Genera un archivo manifest.json
    rollupOptions: {
      input: {
        main: './index.html' // Especifica el punto de entrada
      }
    }
  }
})
