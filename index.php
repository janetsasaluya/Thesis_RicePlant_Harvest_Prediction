<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="./favicon.ico">
	<link rel="stylesheet" href="./assets/style.css?<?php echo time(); ?>">
	<title>RicePlant Prediction</title>
</head>
<body>

	<!-- Notice bar -->
	<div id="notice-bar" >NOTE: STRICTLY UPLOAD RICE PLANT IMAGES ONLY!!!</div>
	
	<!-- Load the image and the CDN -->
	<div id="app">
		
		<!-- Header -->
		<div>
			<div class="mb-2" >
				<div id="modal-trigger">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" style="margin-right: 0.5rem;" viewBox="0 0 16 16">
					  	<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
					</svg>
					<span>RICE PLANT GROWTH CYCLE</span>
				</div>
			</div>
			<h1 class="text-center" >RicePlant Harvest Prediction</h1>
			<h5 class="text-center">Exclusive for TRIPLE-2 (222) Variety only</h5>
			<p>This is a simple prototype wherein you can upload a healthy rice plant picture that you wanted to know its age and whether when will it be harvested. By clicking the box and selecting the rice plant picture you want to upload, it will result into the month age of the rice plant and will show the predicted harvest period.</p>
		</div>

		<main>

			<!-- Main form -->
			<form id="upload-form" >
				<label for="picture-upload" id="picture-preview">
					<div id='picture-loader-parent' >
						<div id="picture-loader" >
							<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
						</div>
					</div>
					<div id="picture-preview-label" class="text-center" >
						<img id="picture-preview-icon" src="assets/plant-cycle/Month-1.svg" />
						<div class="text-bold" >UPLOAD TRIPLE 2 RICEPLANT ONLY</div>
						<div></div>
					</div>
					<img id="picture-preview-holder" src="" />
				</label>
				<input id="picture-upload" type="file" name="rice_image" style="display: none;" >
				<div id="permission-card" >
					<div class="mr-1" ><input id="allow-upload" type="checkbox" name=""></div>
					<label for="allow-upload" >By checking this box, you're allowing us to store your images. Your images will be added to our dataset that will be use for improving our machine learning model.</label>
				</div>
			</form>

			<!-- Result view -->
			<div id="result-panel" >
				<div class="text-center" >
					<h2 id="result-panel-header" >2nd Month</h2>
					<p id="result-panel-body" >Estimated Harvest is on December 2021</p>
				</div>
				<div class="icon-set mt-2" >
					<div data-month="1" class="exact-month icons" ><img style="width: 3rem;" src="assets/plant-cycle/Month-1.svg" /></div>
					<div data-month="2" class="exact-month icons" ><img style="width: 3rem;" src="assets/plant-cycle/Month-2.svg" /></div>
					<div data-month="3" class="exact-month icons" ><img style="width: 6rem;" src="assets/plant-cycle/Month-3.svg" /></div>
					<div data-month="4" class="exact-month icons" ><img style="width: 8rem;" src="assets/plant-cycle/Month-4.svg" /></div>
				</div>
				<div class="text-center mt-2" >
					<p class="text-bold color-primary" >Accuracy <span id="result-accuracy" ></span>%</p>
					<p class="color-gray" >Number of Dataset used 2000+ riceplant images</p>
				</div>
			</div>

			<div class="text-center color-gray" >Brought to you by <span class="color-primary text-bold" >BSCS 4</span></div>

			<div id="modal-triggered" >
				<div id="modal-parent">
					<div id="modal-container">
						<div id="modal-trigger-button" >
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
								<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
								<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
							</svg>
						</div>
						<h1 class="text-center" >RICE PLANT GROWTH CYCLE</h1>
						<img loading="lazy" src="assets/help-cycle/help-flow-chart.png" style="width: 100%" >
					</div>
				</div>
			</div>

		</main>
	</div>

	<script type="text/javascript">
		var modal_trigger = document.querySelector("#modal-trigger");
		var modal_trigger_button = document.querySelector("#modal-trigger-button");
		var model_triggered = document.querySelector("#modal-triggered");
		modal_trigger.addEventListener("click", function(){
			model_triggered.classList.add("show");
		});
		modal_trigger_button.addEventListener("click", function(){
			model_triggered.classList.remove("show");
		});
	</script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js"></script>
	<script>
		(function(){

			// Configurations
			var IS_UPLOAD_IMAGE = false;
			// var UPLOAD_IMAGE_LINK = "http://localhost/AI-image-saver/index.php";
			var UPLOAD_IMAGE_LINK = "https://visionary-commander.000webhostapp.com/index.php";
			var DEBUG = true;
			var PREDICT_DELAY = 1000;
			var IMAGE_SIZE = 256;
			var CLASS_NAMES = [1, 2, 3, 4];
			var CLASS_CONTEXT = [{}, {name: '1st'}, {name: '2nd'}, {name: '3rd'}, {name: '4th'}];
			const DATE_MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

			// DOM elements
			var pictureLoader 	= document.querySelector("#picture-loader-parent");
			var pictureUpload	= document.querySelector("#picture-upload");
			var picturePreview	= document.querySelector("#picture-preview-holder");
			var previewLabel 	= document.querySelector("#picture-preview-label");
			var resultPanel		= document.querySelector("#result-panel");
			var resultPanelMnts = document.querySelectorAll("#result-panel .exact-month");
			var resultPanelHeader	= document.querySelector("#result-panel-header");
			var resultPanelBody		= document.querySelector("#result-panel-body");
			var resultAccuracy 	= document.querySelector("#result-accuracy");
			var uploadForm		= document.querySelector("#upload-form");
			var uploadCheckBox	= document.querySelector("#allow-upload");

			IS_UPLOAD_IMAGE = uploadCheckBox.checked;
			uploadCheckBox.addEventListener("change", function(){
				IS_UPLOAD_IMAGE = this.checked;
			});

			// Load the model and prepare the labels
			var model;
			model = tf.loadLayersModel('cnn_model/model.json');
			model.then((model) => {

				// Listen for onchange event on the image
				pictureUpload.addEventListener("change", async function(e){
					var blobURL = URL.createObjectURL(pictureUpload.files[0]);
					picturePreview.src = blobURL;

					__cleanUp();
					setTimeout(function(){
						__predict(picturePreview).then(__processResult);
					}, PREDICT_DELAY);
				});

				/**
				 * Date helper
				 * @param Number jump - Number of month jump
				 */
				function helperDateJump(jump = 0){
					var now = new Date();
					return new Date(now.getFullYear(), now.getMonth() + jump, 1);
				}

				/** Clean up the result and temporary data */
				function __cleanUp(){
					resultPanel.style.display 	= 'none';
					pictureLoader.style.display = 'block';
					previewLabel.style.display 	= 'none';
					for( var i = 0, x = resultPanelMnts.length; i < x; i++ ){
						resultPanelMnts[i].classList.remove('passed');
					}
				}

				/**
				 * Process the result, use the dom and manipulate the result panel
				 * @param result - The {arrayobject} array
				 */
				function __processResult(result){

					var firstResult = result[0];
					for( var i = 0, x = resultPanelMnts.length; i < x; i++ ){

						if( resultPanelMnts[i].dataset.month == firstResult.className ){
							resultPanelMnts[i].classList.add('passed');
							break;
						}else{
							resultPanelMnts[i].classList.add('passed');
						}
					}

					resultPanelHeader.innerHTML = `${ CLASS_CONTEXT[firstResult.className]['name'] } Month`;

					var helperDate = helperDateJump(4 - firstResult.className);
					resultPanelBody.innerHTML = `Estimated Harvest is on <i>${ DATE_MONTHS[ helperDate.getMonth() ] } ${ helperDate.getFullYear() }</i>`;

					setTimeout(function(){
						window.scroll({
							top: 1000,
							behavior: 'smooth'
						});
					}, 0);

					resultPanel.style.display 	= "block";
					pictureLoader.style.display = "none";
					__modelDebug("DOM: Feedback generated");

					if( IS_UPLOAD_IMAGE ){

						var formData = new FormData(uploadForm);
							formData.append("label", firstResult.className);
						axios({
							url:  UPLOAD_IMAGE_LINK,
							method: "POST",
							data: formData,
							headers: { 'Content-Type': 'multipart/form-data' }
						}).then(data => {
							if( data.data.success ){
								console.log("Image: Uploaded");
							}
						}).catch(err => {
							console.log(err);
						});

					}else{
						console.log("Upload is not permitted.");
					}
				}

				/**
				 * Preprocess, Predict image and return result
				 * @param image_dom - The image DOM to be updated
				 */
				async function __predict(image_dom){
					__modelDebug("Prediction Started");

					const image = tf.browser.fromPixels(image_dom).resizeNearestNeighbor([IMAGE_SIZE, IMAGE_SIZE]).expandDims().toFloat();

					let predictions = await model.predict(image).data();
					let returning_result = Array.from(predictions)
						.map(function (p, i) {
							return { probability: p, className: CLASS_NAMES[i] };
						}).sort(function (a, b) {
							return b.probability - a.probability;
						}).slice(0, 5);

					__modelDebug("Prediction Finished");
					__modelDebug(`Result ${ returning_result[0].className }`);

					resultAccuracy.innerHTML = (returning_result[0].probability * 100).toFixed(2);
					
					return returning_result;
				}

				/**
				 * Model debug
				 * @param debugMessage
				 */
				function __modelDebug(debugMessage){

					if( DEBUG ) console.log(`Model: ${ debugMessage }`);
				}

			})

		})();
	</script>

</body>
</html>