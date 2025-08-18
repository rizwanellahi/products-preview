const tailpress = require('@jeffreyvr/tailwindcss-tailpress')

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./*.php',
		'./**/*.php',
		'./**/**/*.php',
		'./resources/css/*.css',
		'./resources/js/*.js',
		'./safelist.txt',
	],
	theme: {
		extend: {
			colors: {
				primary: {
					900: '#ffffff',
					800: '#89734c',
					700: '#ee8330',
					600: '#f59133',
					500: '#fa9d36',
					400: '#fcaa45',
					300: '#fcb961',
					200: '#fdcd8d',
					100: '#000000',
					50: '#fef3e3',
				},
			},
		},
	},
	plugins: [tailpress.tailwind],
}

// primary: {
// 	900: '#db5e2a',
// 	800: '#e7742d',
// 	700: '#ee8330',
// 	600: '#f59133',
// 	500: '#fa9d36',
// 	400: '#fcaa45',
// 	300: '#fcb961',
// 	200: '#fdcd8d',
// 	100: '#fee1b9',
// 	50: '#fef3e3',
// },
