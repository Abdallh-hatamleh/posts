<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/34eba24764.js" crossorigin="anonymous"></script>
</head>

<body class="w-screen overflow-x-hidden"> 
    <div class="flex justify-center items-center w-screen h-screen overflow-hidden bg-black bg-opacity-80 absolute top-0 z-10 invisible"
        id="Delete_overlay">
        <div class="bg-white rounded p-3 relative w-5/12 lg:w-3/12">
            <button onclick="toggledelete()"
                class="bg-slate-500 text-white rounded-full p-2 w-10 h-10 block text-center absolute -top-4 -right-4">X</button>
            <h2 class="flex justify-center">Are you sure you want to delete this post?</h2>


            <form class="max-w-md mx-auto flex flex-col" action="/posts" method="post" id="deleteform">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete!</button>
            </form>

        </div>
    </div>
    <div class="flex justify-center items-center w-screen h-screen overflow-hidden bg-black bg-opacity-80 absolute top-0 z-10 invisible"
        id="Add_overlay">
        <div class="bg-white rounded p-3 relative w-5/12 lg:w-3/12">
            <button onclick="toggleAdd()"
                class="bg-slate-500 text-white rounded-full p-2 w-10 h-10 block text-center absolute -top-4 -right-4"
                id="close-add">X</button>
            <h2 class="flex justify-center">Make a post</h2>


            <form class="max-w-md mx-auto flex flex-col" action="/posts" method="post">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="title" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Post
                        title</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="">Tags: </label>
                    <select name="" id="tag-selector" class="p-1">
                        @foreach (App\Models\tag::all() as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="taglist" class="grid grid-cols-autofill-7 my-4">

                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <textarea type="text" name="body" id="floating_repeat_password"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required></textarea>
                    <label for="floating_repeat_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Post
                        body</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">

                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Post!</button>
            </form>

        </div>
    </div>
    <button onclick="toggleAdd()" class="m-4 bg-blue-400 p-2 rounded" id="addpost">
        Add post
    </button>
    <div class="min-h-screen w-screen flex items-center p-12 space-y-4 flex-col relative">

        @foreach ($posts as $post)
            <div class="bg-cyan-400 h-fit rounded py-4 w-6/12 drop-shadow-lg border">
                    <button class="p-2 rounded-full bg-white w-10 h-10 absolute top-0 right-0" onclick="opendelete('{{$post->id}}')"> <i class="fa-solid fa-trash" style="color: #6d0101;"></i></button>
                <div>
                    <h2 class="text-center text-2xl">{{$post->title}}</h2>
                    <div class="border space-x-1 flex px-1">
                        @foreach ($post->tags as $tag)
                            <a href="/tags/{{$tag->id}}" class="bg-yellow-400 h-full block px-2">{{$tag->name}}</a>
                        @endforeach
                    </div>
                </div>
                <article class="m-2 text-wrap">
                    {{$post->body}}
                </article>
            </div>
        @endforeach
    </div>
    <script>
        function toggleAdd() {
            document.getElementById('Add_overlay').classList.toggle('invisible');
            document.body.classList.toggle('h-screen')
            document.body.classList.toggle('overflow-hidden')
        }
        let taglist = document.querySelector('#taglist');
        let options = document.querySelectorAll('option');
        options.forEach(element => {
            element.addEventListener('click', e => {
                let newtag = document.createElement('div')
                let tagname = e.target.innerText
                let tagID = e.target.value
                let existingTag = document.getElementById(`tag${tagID}`);

                // Check if the tag already exists
                if (!existingTag) {
                    let newtag = document.createElement('div');
                    newtag.id = `tag${tagID}`;

                    newtag.innerHTML = `
                        <h3>${tagname}
                            <button onclick="deleteElem('${tagID}')">
                                <i class="fa-solid fa-trash" style="color: #6d0101;"></i>
                            </button>
                        </h3>
                        <input type='hidden' value='${tagID}' name='tags[]'>
                    `;

                    taglist.appendChild(newtag);
                } else {
                    console.log('Tag already added');
                }
            })
        });
        function deleteElem(tagid) {
            document.getElementById(`tag${tagid}`).remove();
        }
        function opendelete(id)
        {
            window.scrollTo(0, 0);
            document.getElementById('deleteform').action = `/posts/${id}`;
            document.body.classList.toggle('h-screen')
            document.body.classList.toggle('overflow-hidden')
            document.getElementById('Delete_overlay').classList.toggle('invisible');
        }
        function toggledelete(){
            document.body.classList.toggle('h-screen')
            document.body.classList.toggle('overflow-hidden')
            document.getElementById('Delete_overlay').classList.toggle('invisible');
        }
    </script>
</body>

</html>