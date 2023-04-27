<div style="text-align: center; padding-bottom: 30px;">

   <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px;">Comments</h1>
 
   <form action="{{url('add_comment')}}" method="POST" style="max-width: 600px; margin: 0 auto;">
 
     @csrf
 
     <textarea style="height: 150px; width: 100%; resize: vertical; border-radius: 5px; padding: 10px; box-sizing: border-box;" placeholder="Comment something here" name="comment" required=""></textarea>
 
     <br>
 
     <input type="submit" class="btn btn-primary" value="Comment" style="margin-top: 10px;">
 
   </form>
 
 </div>
 
 <div style="max-width: 800px; margin: 0 auto;">
 
   <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>
 
   @foreach($comment as $comment)
 
   <div style="padding-bottom: 20px; background-color: #f0f0f0; border-radius: 5px; padding: 15px; margin-bottom: 20px;">
 
     <b>{{$comment->name}}</b>
     <p>{{$comment->comment}}</p>
 
     <a style="color: blue; cursor: pointer;" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
 
     @foreach($reply as $rep)
 
     @if($rep->comment_id==$comment->id)
 
     <div style="padding-left: 3%; padding-bottom: 20px; padding-bottom: 10px; background-color: #e0e0e0; border-radius: 5px; padding: 10px; margin-top: 10px;">
 
       <b>{{$rep->name}}</b>
       <p>{{$rep->reply}}</p>
       <a style="color: blue; cursor: pointer;" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
 
     </div>
 
     @endif
 
     @endforeach
 
   </div>
 
   @endforeach
 
   <!--  Reply Textbox -->
 
   <div style="display: none; padding-bottom: 20px;" class="replyDiv">
 
     <form action="{{url('add_reply')}}" method="POST">
 
       @csrf
 
       <input type="text" id="commentId" name="commentId" hidden="">
 
       <textarea style="height: 100px; width: 100%; resize: vertical; border-radius: 5px; padding: 10px; box-sizing: border-box;" name="reply" placeholder="write something here" required=""></textarea>
 
       <br>
 
       <button type="submit" class="btn btn-warning" style="margin-top: 10px;">Reply</button>
 
       <a href="javascript::void(0);" class="btn" onClick="reply_close(this)" style="margin-top: 10px;">Close</a>
 
     </form>
 
   </div>
 
 </div>
