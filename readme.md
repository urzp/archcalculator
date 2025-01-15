# archcalculator

### Installation on the server:

The production files are located in the dist folder.
All files need to be uploaded to the root folder of the site on the server (public_html)


### Output part of the project Folder dist:

The dist folder is the output of the entire project that is "rebuilt" when changes are made to the project.
A folder with the backend php. The original folder for the backend-php is located in public.
Changes can be made to it that will be updated in the output dist when rebuilding the project (npm run build)
Also, you can add necessary packages to the publiс folder that will be in the outpu

### Frontend project.

The frontend project is located in the src folder.
For installation and running on a local server
Requires Node.js and Git package  

### Installing Visualstudio

This Vue 3 project was developed using Visual Studio, leveraging its comprehensive tooling for web development. Visual Studio provides features like code completion, debugging, and project management, contributing to a smooth and efficient development experience.
Installer:  https://code.visualstudio.com/download

### Installing Node.js

Node.js is a JavaScript runtime environment. Node.js can be installed by downloading the installer from the official website, or using a package manager. Version 16 or 18 LTS is required.

Windows:
Installer: https://nodejs.org/en/download/
winget: winget install OpenJS.NodeJS.LTS
Chocolatey: choco install nodejs-lts
Mac:
Installer: https://nodejs.org/en/download/
brew: brew install node@18
Linux: https://nodejs.org/en/download/package-manager/

### Installing Git

Git is a distributed version control system, a tool without which modern development is difficult to imagine.

Install git
https://git-scm.com/downloads

### Installation for working with the frontend part in vue

For installation and running on a local server
Requires Node.js and Git package

You can download:
```
git clone https://github.com/urzp/archcalculator.git
```

Enter the project folder:
```
cd media_node
```

Install dependencies:
```
npm ci
```

Run on a local server:
```
npm run serve
```

Generating output files:
```
npm run build
```



## Other npm commands:

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
