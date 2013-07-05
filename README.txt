iNaturalist projects library 1.0

What is iNaturalist projects library?

This project is aimed at creating a shared library that can be used to integrate iNaturalist.org with multiple platforms. The primary targets at the moment are Drupal and Wordpress. This project makes use of the iNaturalist API to interact with the site.

The idea is to provide a portable library that can be embedded on various platforms with little technical requirement.

The following html files can be embedded as objects on any webpage:

  1.  index.html
      Description: ~need to add
      Dependencies: ~need to add

  2.  login.html
      Description: ~need to add
      Dependencies: ~need to add

  3.  register.html
      Description: ~need to add
      Dependencies: ~need to add

  4.  add_obs.html
      Description: ~need to add
      Dependencies: ~need to add

See iNat API Reference: http://www.inaturalist.org/pages/api+reference
Latest deployment can be found at: http://iseahorse.org/inat_test/

Installation Instructions

1.0 Setting up the project JSON

  1.1 Download the file at https://www.inaturalist.org/projects/'project'.json, where 'project' is the name of your project (e.g. https://www.inaturalist.org/projects/iseahorse.json).

  2.2 Change the name of the file you downloaded in (1) from 'project'.json to project.json (e.g. iseahorse.json to project.json)

  3.3 Move the file in (2) to ~/inat/, where ~ is the root of your library (i.e. the file location is ~/inat/project.json).
