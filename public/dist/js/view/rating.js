// fungsi hapus
function deleteModalHandler(index) {
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
}

const stars=document.querySelectorAll(".star");
const rating=document.getElementById("rating");

if(rating.value!=''){
    stars.forEach((star,currIndex,index1)=>{
        currIndex=(rating.value)-1;
        stars.forEach((star,currIndex2)=>{
            if(currIndex>=currIndex2){
                star.classList.add("active");
            }
        })

        // Add an event listener that runs a function when the "click" event is triggered
        star.addEventListener("click",()=>{
        //Loop through the "stars" NodeList again
        stars.forEach((star,index2)=>{
        //Add the "active" class to  the clicked star and any stars with a lower index
        //Remove the "active" class from any stars with higher index
            if(index1>=index2){
                star.classList.add("active");
                rating.value=index1+1;
            }else{
                star.classList.remove("active");
                }
            })
        })

    })
}

stars.forEach((star,index1)=>{
    // Add an event listener that runs a function when the "click" event is triggered
    star.addEventListener("click",()=>{
        //Loop through the "stars" NodeList again
        stars.forEach((star,index2)=>{
        //Add the "active" class to  the clicked star and any stars with a lower index
        //Remove the "active" class from any stars with higher index
            if(index1>=index2){
                star.classList.add("active");
                rating.value=index1+1;
            }else{
                star.classList.remove("active");
                }
            })
    })
})
// stars.forEach((star,index1)=>{
//     // Add an event listener that runs a function when the "click" event is triggered
//     star.addEventListener("click",()=>{
//         //Loop through the "stars" NodeList again
//         stars.forEach((star,index2)=>{
//         //Add the "active" class to  the clicked star and any stars with a lower index
//         //Remove the "active" class from any stars with higher index
//             if(index1>=index2){
//                 star.classList.add("active");
//                 rating.value=index1+1;
//             }else{
//                 star.classList.remove("active");
//                 }
//             })
//     })
// })




