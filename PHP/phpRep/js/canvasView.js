if (!Detector.webgl)
	Detector.addGetWebGLMessage();
var container, clock, mixer;
var camera, scene, renderer, objects;
var loader;
var mouseDown = false;
var clock = new THREE.Clock();
init();
animate();

var angleX = 0;
var angleY = -100;
var angleZ = 0;
var radius = 400;
var rotSpeed = 0.003;

container.addEventListener("mousedown", function() {
	mouseDown = true
});
container.addEventListener("mouseup", function() {
	mouseDown = false
});

function init() {
	container = document.getElementById('canvas');

	camera = new THREE.PerspectiveCamera(45, window.innerWidth
			/ window.innerHeight, 1, 2000);
	camera.position.set(radius * Math.cos(angleX), radius * Math.cos(angleY),
			radius * Math.sin(angleZ));
	controls = new THREE.OrbitControls(camera);
	// camera.position.set(2, 4, 5);
	clock = new THREE.Clock();
	scene = new THREE.Scene();
	scene.fog = new THREE.FogExp2(0x000000, 0.035);
	mixer = new THREE.AnimationMixer(scene);
	loader = new THREE.ObjectLoader();

	
	// lights
	var ambientLight = new THREE.AmbientLight(0x444444);
	scene.add(ambientLight);
	var pointLight = new THREE.PointLight(0x999999, 5, 30);
	pointLight.position.set(5, 0, 0);
	scene.add(pointLight);
	// renderer
	renderer = new THREE.WebGLRenderer({
		antialias : true,
		alpha : true
	});
	renderer.setPixelRatio(window.devicePixelRatio);
	renderer.setSize(window.innerWidth, window.innerHeight);
	container.appendChild(renderer.domElement);

	// events
	window.addEventListener('resize', onWindowResize, false);
	objectLoader("./obj/spaceship1.json");
	

	scene.fog = new THREE.Fog(0xa0a0a0, 200, 1000);

	grid = new THREE.GridHelper(2000, 20, 0x000000, 0x000000);
	grid.material.opacity = 0.2;
	grid.material.transparent = true;
	grid.position.y = -200;
	scene.add(grid);
}

function objectLoader(url) {
	loader.load(
		// resource URL
		url,
		// onLoad callback
		// Here the loaded data is assumed to be an object
		function(obj) {
			// Add the loaded object to the scene
			scene.add(obj);
		},
		// onProgress callback
		function(xhr) {
			console.log((xhr.loaded / xhr.total * 100) + '% loaded');
		},
		// onError callback
		function(err) {
			console.error('An error happened');
	});
}

function onWindowResize(event) {
	renderer.setSize(window.innerWidth, window.innerHeight);
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
}
//
function animate() {
	requestAnimationFrame(animate);
	render();
}
function render() {
	if (!mouseDown) {
		//var delta = clock.getDelta();
		var timer = Date.now() * 0.0003;
		camera.position.x = Math.cos(timer) * 4;
		camera.position.y = 2;
		camera.position.z = Math.sin(timer) * 4;
		//var x = camera.position.x, y = camera.position.y, z = camera.position.z;
		//camera.position.x = x * Math.cos(rotSpeed) + z * Math.sin(rotSpeed);
		//camera.position.z = z * Math.cos(rotSpeed) - x * Math.sin(rotSpeed);
	}
	mixer.update(clock.getDelta());
	camera.lookAt(scene.position);
	renderer.render(scene, camera);
}