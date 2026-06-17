const https = require('https');
https.get('https://unsplash.com/s/photos/rice-field', (res) => {
  let data = '';
  res.on('data', chunk => data += chunk);
  res.on('end', () => {
    const regex = /https:\/\/images\.unsplash\.com\/photo-[a-zA-Z0-9\-]+/g;
    const matches = [...new Set(data.match(regex))].slice(0, 10);
    console.log(matches);
  });
});
