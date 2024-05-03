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

  exports.getAllProjects = async (req, res, next) => {
    try {
      const projects = await Project.find(); 
      res.json(projects); 
  } catch (error) {
      console.error('Error fetching projects:', error);
      res.status(500).send('Internal Server Error');
  }
};

exports.addManagerToProject = async (req, res) => {
  try {
    const { id } = req.params;
    const { manager } = req.body;

    const project = await Project.findById(id);
    const foundManager = await User.findById(manager);

    if (!project || !foundManager) {
      return res.status(404).json({ message: 'Project or manager not found' });
    }

    project.manager = foundManager;
    await project.save();

    res.redirect(`/projects/${id}`);
  } catch (error) {
    res.status(500).json({ message: 'Failed to add manager to project', error: error.message });
  }
};
  