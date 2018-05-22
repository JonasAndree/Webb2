
var container, stats;
var camera, scene, renderer;
var mouseX = 0, mouseY = 0;
var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;
init();
animate();
function init() {
	container = document.getElementById("canvas");
	camera = new THREE.PerspectiveCamera(45, window.innerWidth
			/ window.innerHeight,  1, 2000);
	camera.position.z = 50;
	// scene
	scene = new THREE.Scene();
	var ambientLight = new THREE.AmbientLight(0xcccccc, 0.4);
	scene.add(ambientLight);
	var pointLight = new THREE.PointLight(0x35d1ff, 0.8);
	camera.add(pointLight);
	scene.add(camera);
	// model
	/*var onProgress = function(xhr) {
		if (xhr.lengthComputable) {
			var percentComplete = xhr.loaded / xhr.total * 100;
			console.log(Math.round(percentComplete, 2) + '% downloaded');
		}
	};
	var onError = function(xhr) {
	};
	THREE.Loader.Handlers.add(/\.dds$/i, new THREE.DDSLoader());
	new THREE.MTLLoader().setPath('obj/').load(
			'spaceshipBottom.mtl',
			function(materials) {
				materials.preload();
				new THREE.OBJLoader().setMaterials(materials).setPath(
						'obj/').load('spaceshipBottom.obj',
						function(object) {
							object.position.y = 0;
							scene.add(object);
						}, onProgress, onError);
			});
*/
	
	// model
	var loader = new THREE.FBXLoader();
	loader.load( './obj/spaceship.fbx', function ( object ) {
		object.mixer = new THREE.AnimationMixer( object );
		mixers.push( object.mixer );
		var action = object.mixer.clipAction( object.animations[ 0 ] );
		action.play();
		object.traverse( function ( child ) {
			if ( child.isMesh ) {
				child.castShadow = true;
				child.receiveShadow = true;
			}
		} );
		scene.add( object );
	} );
	update3D();
	//
	renderer = new THREE.WebGLRenderer({ alpha: true });
	renderer.setPixelRatio(window.devicePixelRatio);
	renderer.setSize(window.innerWidth, window.innerHeight);
	container.appendChild(renderer.domElement);
	document.addEventListener('mousemove', onDocumentMouseMove, false);
	//
	window.addEventListener('resize', onWindowResize, false);

}


function add3DOBJ(objName) {
	var onProgress = function(xhr) {
		if (xhr.lengthComputable) {
			var percentComplete = xhr.loaded / xhr.total * 100;
			console.log(Math.round(percentComplete, 2) + '% downloaded');
		}
	};
	var onError = function(xhr) {
	};
	
	new THREE.MTLLoader().setPath('obj/').load(objName+'.mtl',
			function(materials) {
				materials.preload();
				new THREE.OBJLoader().setMaterials(materials).setPath(
						'obj/').load(objName+'.obj',
						function(object) {
							object.name = objName;
							object.position.y = 0;
							scene.add(object);
						}, onProgress, onError);
			});
}
function delete3DOBJ(objName){
    var selectedObject = scene.getObjectByName(objName);
    scene.remove( selectedObject );
}


function onWindowResize() {
	windowHalfX = window.innerWidth / 2;
	windowHalfY = window.innerHeight / 2;
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize(window.innerWidth, window.innerHeight);
}
function onDocumentMouseMove(event) {
	mouseX = (event.clientX - windowHalfX) / 2;
	mouseY = (event.clientY - windowHalfY) / 2;
}
//
function animate() {
	requestAnimationFrame(animate);
	render();
}
var elapsedTime = 0;
function render() {
	//camera.position.x += (mouseX - camera.position.x) * .05;
	//camera.position.y = Math.cos(mouseX *.005)*100;
	//camera.position.z = ;
	//camera.position.x = Math.cos(i++*0.05)*100;
	var radius = 40;
	var constant = 0.008;
	elapsedTime++;
	if (elapsedTime > 360/constant)
		elapsedTime = 0;
	camera.position.y = scene.position.y + radius * Math.cos( constant * mouseX*0.2 );
	camera.position.x = scene.position.x + radius * Math.cos( constant * elapsedTime )*Math.cos( constant * mouseX*0.2 );         
	camera.position.z = scene.position.z + radius * Math.sin( constant * elapsedTime )*Math.cos( constant * mouseX*0.2 );
	camera.lookAt(scene.position);
	renderer.render(scene, camera);
}
