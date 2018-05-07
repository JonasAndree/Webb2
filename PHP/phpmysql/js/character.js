if (!Detector.webgl)
	Detector.addGetWebGLMessage();

var container, stats, controls;
var camera, scene, renderer, light;
var clock = new THREE.Clock();
var mixers = [];
var loader;
var spaceShip;
var initTime;
var newObject = false;
var initObj = false; 
var counter = 0;
var grid;
var mouseDown = false;

var elapsedTime = 0;
var angleX = 0;
var angleY = -100;
var angleZ = 0;

var radius = 400;
var spaceShipeCreated = false;

var rotSpeed = 0.003;


init();
animate();


container.addEventListener("mousedown", function() {mouseDown = true});
container.addEventListener("mouseup", function() {mouseDown = false});

	
function init() {
	container = document.getElementById("canvas");
	/*
	 * light = new THREE.AmbientLight(0x222222, 0.4); light = new
	 * THREE.HemisphereLight(0xffffff, 0x444444); light.position.set(0, 200, 0);
	 * scene.add(light); light = new THREE.PointLight(0x35d1ff, 0.02, 0.08);
	 * light.position.set(0, 200, 100); light.castShadow = true;
	 * light.shadow.camera.top = 180; light.shadow.camera.bottom = -100;
	 * light.shadow.camera.left = -120; light.shadow.camera.right = 120;
	 * scene.add(light); scene.add( new THREE.CameraHelper( light.shadow.camera ) );
	 */

	renderer = new THREE.WebGLRenderer({
		antialias : true,
		alpha: true
	});
	renderer.setPixelRatio(window.devicePixelRatio);
	renderer.setSize(window.innerWidth, window.innerHeight);
	renderer.shadowMap.enabled = true;
	container.appendChild(renderer.domElement);
	window.addEventListener('resize', onWindowResize, false);
	
	loader = new THREE.FBXLoader();
	add3DOBJ("spaceship");
}

function init2 () {
	update3D();
	console.log("spaceShip position: " + spaceShip.position.x);
	
	camera = new THREE.PerspectiveCamera(45, window.innerWidth
			/ window.innerHeight, 1, 2000);
	camera.position.set(radius * Math.cos( angleX ), 
						radius * Math.cos( angleY ), 
						radius * Math.sin( angleZ ));
	
	camera.lookAt(spaceShip.position);
	controls = new THREE.OrbitControls(camera);
	controls.target.set(spaceShip.position.x, spaceShip.position.y, spaceShip.position.z);
	controls.update();
	scene = new THREE.Scene();
	scene.fog = new THREE.Fog(0xa0a0a0, 200, 1000);
	
	grid = new THREE.GridHelper(2000, 20, 0x000000, 0x000000);
	grid.material.opacity = 0.2;
	grid.material.transparent = true;
	grid.position.y = -200;
	
	scene.add(grid);
	
}
function onWindowResize() {
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize(window.innerWidth, window.innerHeight);
}

function animate() {
	requestAnimationFrame(animate);
	if (mixers.length > 0) {
		var delta = clock.getDelta();
		for (var i = 0; i < mixers.length; i++) {
			mixers[i].update(delta);			
		}
		
		if (!mouseDown) {
			camera.lookAt(spaceShip.position);
			var x = camera.position.x, y = camera.position.y, z = camera.position.z;
			camera.position.x = x * Math.cos(rotSpeed) + z * Math.sin(rotSpeed);
			camera.position.z = z * Math.cos(rotSpeed) - x * Math.sin(rotSpeed);

		}  
		renderer.render(scene, camera);
	}
}

function initAnimate() {
	// requestAnimationFrame(animate);
	// renderer.render(scene, camera);
}
function add3DOBJ(objName) {
	loader.load('./obj/'+objName+'.fbx', function(object) {
		object.mixer = new THREE.AnimationMixer(object);
		object.name = objName;
		var action = object.mixer.clipAction(object.animations[0]);
		mixers.push(object.mixer);
		action.play();
		object.traverse(function(child) {
			if (child.isMesh) {
				child.castShadow = true;
				child.receiveShadow = true;
			}
		});
		if(object.name == "spaceship"){
			spaceShip = object;
			console.log("spaceship created");
			spaceShipeCreated = true;
			init2();
		}
		scene.add(object);
	});
}
function delete3DOBJ(objName){
    var selectedObject = scene.getObjectByName(objName);
    scene.remove( selectedObject );
}
function update3D(){

	for (var i = 0; i < subtypes.length; i++){
		var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var objName = this.responseText;
				getObjFromDatabase(objName);
			}
		};
		xmlhttp.open("GET", "getItemName.php?q=" + subtypes[i], true);
		xmlhttp.send();
	}
	
}
function getObjFromDatabase(objName) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var obj = this.responseText;
			update3DOBJ(obj, objName); 
		}
	};
	xmlhttp.open("GET", "getObjectFromDatabase.php?q=" + objName, true);
	xmlhttp.send();
}
function update3DOBJ(blobObject, objName) {
	// Blob or File objects created when dragging files into the webpage.
	/*var blobs = {'objName.fbx': blobobject};
	var manager = new THREE.LoadingManager();
	// Initialize loading manager with URL callback.
	var objectURLs = [];
	manager.setURLModifier((url) => {
		url = URL.createObjectURL(blobs['objName.fbx'] );
		objectURLs.push( url );
		return url;
	});*/
	
	//var url = URL.createObjectURL(blobobject);
	
	/*var binaryData = [];
	binaryData.push(blobObject);
	var url = URL.createObjectURL(new Blob(binaryData, {type: "fbx"}))
	console.log(url);
	console.log(blobObject);*/
	
//	var blob = new Blob(blobobject, {type: "fbx"}),
  //  var url = URL.createObjectURL(blob),
	//loader = new THREE.FBXLoader();	

	// Construct a file
//	var file = new File([blobObject], "objName.fbx");
//	var url = URL.createObjectURL(file);
	
	loader.load(blobObject, function(object) {
		console.log("object: "+object);
		console.log("objName: " + objName);
		object.mixer = new THREE.AnimationMixer(object);
		object.name = objName;
		var action = object.mixer.clipAction(object.animations[0]);
		mixers.push(object.mixer);
		action.play();
		object.traverse(function(child) {
			if (child.isMesh) {
				child.castShadow = true;
				child.receiveShadow = true;
			}
		});
		scene.add(object);

	});
	
	/*
	if (itemName == "NightrogenBlaster") {
		delete3DOBJ("IonBlaster");
		add3DOBJ(itemName);
	} else if (itemName == "IonBlaster") {
		delete3DOBJ("NightrogenBlaster");
		add3DOBJ(itemName);
	} */
}
