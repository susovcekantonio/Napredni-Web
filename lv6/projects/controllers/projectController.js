const Project = require('../models/projects');

exports.createProject = async (req, res) => {
  try {
    const project = await Project.create(req.body);
    res.status(201).json(project);
  } catch (err) {
    res.status(400).json({ message: err.message });
  }
};

exports.updateProject = async (req, res) => {
    try {
      const project = await Project.findByIdAndUpdate(req.params.id, req.body, { new: true });
      res.json(project);
    } catch (err) {
      res.status(400).json({ message: err.message });
    }
  };
  
  exports.deleteProject = async (req, res) => {
    try {
      await Project.findByIdAndDelete(req.params.id);
      res.status(204).end();
    } catch (err) {
      res.status(400).json({ message: err.message });
    }
  };
  
  exports.getProject = async (req, res) => {
    try {
      const project = await Project.findById(req.params.id);
      if (!project) {
        return res.status(404).json({ message: 'Project not found' });
      }
      res.json(project);
    } catch (err) {
      res.status(400).json({ message: err.message });
    }
  };
  