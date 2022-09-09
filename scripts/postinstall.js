const fs = require('fs');
const fse = require('fs-extra');
const path = require('path');

const components = fs.readdirSync('node_modules/@psu-ooe/');
components.forEach(component => {
  const manifest = require(path.join('../', 'node_modules', '@psu-ooe', component, 'package.json'));
  const namespace = manifest.ooe.namespace;
  fse.copy(
      path.join('node_modules', '@psu-ooe', component),
      path.join('components', namespace, component),
      { recursive: true, overwrite: true }
  ).then(() => {
    fse.copySync(
        path.join('components', 'global', 'webfonts', 'webfonts'),
        path.join('source', 'webfonts'),
        { recursive: true, overwrite: true }
    );
  }).then(() => {
    const source_dir = path.join('source', 'js');
    if (!fse.existsSync(source_dir)) {
      fse.mkdirSync(source_dir);
    }
    const script = path.join('components', namespace, component, 'dist', 'scripts.js');
    if (fse.existsSync(script)) {
      fse.copySync(
          script,
          path.join('source', 'js', namespace, component, 'dist', 'scripts.js'),
          { overwrite: true }
      );
    }
  }).then(() => {
    const source_dir = path.join('source', 'css');
    if (!fse.existsSync(source_dir)) {
      fse.mkdirSync(source_dir);
    }
    const script = path.join('components', namespace, component, 'dist', 'styles.css');
    if (fse.existsSync(script)) {
      fse.copySync(
          script,
          path.join('source', 'css', namespace, component, 'dist', 'styles.css'),
          { overwrite: true }
      );
    }
  });

});