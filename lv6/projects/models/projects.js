const mongoose = require('mongoose');

const projectSchema = new mongoose.Schema({
  name: { type: String, required: true },
  description: { type: String, required: true },
  price: { type: Number, required: true },
  tasks: [{ type: String }],
  startDate: { type: Date, default: Date.now },
  endDate: { type: Date },
  teamMembers: [{
    firstName: String,
    lastName: String,
    email: String
  }]
});

const Project = mongoose.model('Project', projectSchema);

module.exports = Project;
