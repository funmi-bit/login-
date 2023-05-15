let foundclothes,foundSize,foundList,foundprice;

//parallel array of the heroes 
let clotheName = ["hoodie", "shoes", "hat", "shirt", "jogger set"];

let cl_size = ["small", "medium", "large", "xsmall", "xlarge"];


//the pictures are currently here as a reference
//they have not been used

let clothes = [
	["Hoodie.webp", "20.00", "bluehoodie.webp","30.00" ]
	["shoes.webp", "trainers.webp", "shoe.webp"],
	["blackhat.webp", "bluehat.jpg", "hat.webp", "whitehat.jpg"],
	["Men's-Tee.webp","TrainingTee.webp"],
	["jogger-set.webp"],  
]

let prices = [
	["30.00", "29.00"],
	["£0","£0","£0"],
	["£0","£0","£0","£0"],
	["£0","£0"],
	["£0"],
]

let item = prompt("What item do you want?"); 
let size = prompt("what is your size:");

//loop through the heroes finding any that max
//why is the loop only finding one hero?
for(let i = 0 ; i < clotheName.length; i++){
	if(clotheName[i] === item){		
			foundclothes = i // assign the index to found
	} 
}

for(let i = 0 ; i < cl_size.length; i++){
	if(cl_size[i] === size){
			foundSize = cl_size[i] // assign the label to size
	}
}


if(foundclothes>=0){	
	alert("You need: " + clotheName[foundclothes]);
	let img = clothes[foundclothes];
	for(let i = 0;i <img.length;i++) {
		let pic = img[i];
		display_image(pic);
		
	}
}




function display_image(src, width=300, height=300, alt="a pic") {
    var pic = document.createElement("img");
    pic.src = src;
    pic.width = width;
    pic.height = height;
    pic.alt = alt;
    document.body.appendChild(pic);
}

/*let form1 = document.getElementById("form");

document.getElementById("submit").addEventListener("click", function () {
  form1.submit();
});*/






/*for(let i = 0;i <prices.length;i++) {
		let price = prices[i];
		document.write(price[i]); */










