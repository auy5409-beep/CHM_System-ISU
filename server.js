// server.js
const express = require("express");
const path = require("path");
const app = express();
const PORT = 3000;

// Serve all files (HTML, CSS, JS, images)
app.use(express.static(path.join(__dirname)));

// Default route: load your homepage
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "home.html")); // change to your actual homepage file
});

// Start server
app.listen(PORT, () => {
  console.log(`✅ CampusHealth running at: http://localhost:${3000}`);
});
