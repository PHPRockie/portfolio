export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/**/*.php",
  ],
  safelist: [
    'bg-blue-600', 'bg-blue-500',
    'bg-green-600',
    'bg-purple-600',
    'bg-yellow-500', 'text-gray-900',
    'bg-cyan-600',
    'bg-orange-500', 'bg-orange-600',
    'bg-red-700',
    'bg-emerald-600',
    'bg-sky-600',
    'bg-gray-600',
  ],
  theme: { extend: {} },
  plugins: [],
}
