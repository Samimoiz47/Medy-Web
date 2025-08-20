import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

let scene, camera, renderer;
let mixers = [];
const clock = new THREE.Clock();

function init() {
  const container = document.getElementById('threejs-container');

  scene = new THREE.Scene();
  scene.background = new THREE.Color(0x0a0a0f);

  camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
  camera.position.set(0, 2, 5);

  renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setSize(container.clientWidth, container.clientHeight);
  container.appendChild(renderer.domElement);

  // Lights
  const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
  scene.add(ambientLight);

  const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
  directionalLight.position.set(5, 10, 7.5);
  scene.add(directionalLight);

  // Load models from game cards
  const gameCards = document.querySelectorAll('.game-card-3d');
  const loader = new GLTFLoader();

  gameCards.forEach((card, index) => {
    const modelPath = card.getAttribute('data-model');
    if (!modelPath) return;

    loader.load(
      `/models/${modelPath}`,
      (gltf) => {
        const model = gltf.scene;
        model.position.set((index - (gameCards.length - 1) / 2) * 3, 0, 0);
        model.scale.set(1.5, 1.5, 1.5);
        scene.add(model);

        if (gltf.animations && gltf.animations.length) {
          const mixer = new THREE.AnimationMixer(model);
          gltf.animations.forEach((clip) => {
            mixer.clipAction(clip).play();
          });
          mixers.push(mixer);
        }
      },
      undefined,
      (error) => {
        console.error('Error loading model:', modelPath, error);
      }
    );
  });

  window.addEventListener('resize', onWindowResize, false);

  animate();
}

function onWindowResize() {
  const container = document.getElementById('threejs-container');
  camera.aspect = container.clientWidth / container.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(container.clientWidth, container.clientHeight);
}

function animate() {
  requestAnimationFrame(animate);

  const delta = clock.getDelta();
  mixers.forEach((mixer) => mixer.update(delta));

  renderer.render(scene, camera);
}

init();
