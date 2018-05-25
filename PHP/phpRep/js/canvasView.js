if (!Detector.webgl)
	Detector.addGetWebGLMessage();
var container, clock, mixer;
var camera, scene, renderer, objects;
var objloader;
var jsonloader;
var mouseDown = false;
var clock = new THREE.Clock();
var angleX = 4;
var angleY = 3.44;
var angleZ = 0;
var radius = 4;
var elapsedTime = 0;
var rotSpeed = 0.003;

init();
animate();

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

	controls = new THREE.OrbitControls(camera);
	camera.position.set(1.54, 1.8, 3.78);
	clock = new THREE.Clock();
	scene = new THREE.Scene();
	scene.fog = new THREE.FogExp2(0x000000, 0.035);
	mixer = new THREE.AnimationMixer(scene);
	objloader = new THREE.ObjectLoader();
	jsonloader = new THREE.ObjectLoader();

	// lights
	var ambientLight = new THREE.AmbientLight(0x444444);
	scene.add(ambientLight);
	var pointLight = new THREE.PointLight(0x99FF99, 2, 30);
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
	objectLoader("./obj/IonBlaster.json");

	scene.fog = new THREE.Fog(0xa0a0a0, 200, 1000);

	grid = new THREE.GridHelper(2000, 20, 0x000000, 0x000000);
	grid.material.opacity = 0.2;
	grid.material.transparent = true;
	grid.position.y = -200;
	scene.add(grid);
}

function objectLoader(url) {
	objloader.load(
	// resource URL
	url,
	// onLoad callback
	// Here the loaded data is assumed to be an object
	function(obj) {
		// Add the loaded object to the scene
		obj.name = "spaceShip";
		// camera.lookAt(obj.position);
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

function jsonLoader(url) {
	// resource URL
	url,

	// onLoad callback
	function(geometry, materials) {
		var material = materials[0];
		var object = new THREE.Mesh(geometry, material);
		scene.add(object);
	},

	// onProgress callback
	function(xhr) {
		console.log((xhr.loaded / xhr.total * 100) + '% loaded');
	},

	// onError callback
	function(err) {
		console.log('An error happened');
	}
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
		// var delta = clock.getDelta();
		var timer = Date.now() * 0.0003;
		// var x = camera.position.x, y = camera.position.y, z =
		// camera.position.z;
		// camera.lookAt(object.position);
		var x = camera.position.x, y = camera.position.y, z = camera.position.z;
		camera.position.x = x * Math.cos(rotSpeed) + z * Math.sin(rotSpeed);
		camera.position.z = z * Math.cos(rotSpeed) - x * Math.sin(rotSpeed);
	}

	// console.log("x:" + camera.position.x ," y:" + camera.position.y,
	// " z:"+camera.position.z);
	mixer.update(clock.getDelta());
	camera.lookAt(scene.position);
	renderer.render(scene, camera);
}