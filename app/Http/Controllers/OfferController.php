<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use Validator;
use Redirect;
use App\Imoffer;
use Session;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_offers()
    {
        return view('admin.add_offers_form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_offers_save(Request $r)
    {
    $title = $r->input('title');
      $content = $r->input('content');
      $category = $r->input('cat_id');
           $price = $r->input('price');

      
      $files = $r->file('attachments');

      $data = ['title' => $title,'content'=> $content, 'cat_id' => $category,'attachments' => $files,'price' => $price];

      $rules = ['title' => 'required' ,'content' => 'required','cat_id' => 'required','attachments'=> 'required','price' => 'required'];

      $v = Validator::make($data, $rules);

      if($v->fails()){
        return Redirect::Back()->withErrors($v);
      }else
      {
       if ($files[0] != '') {
        $image_name = array();
        foreach($files as $file) {
         $ran = mt_rand(111111,999999);
         $destinationPath = 'uploads/offers';
         $filename = $file->getClientOriginalExtension();
         $filename_r =$ran.'.'.$filename;
         $image_name[] = $filename_r;
         $file->move($destinationPath, $filename_r);
       }
     }

     $offer = new Offer();
     $offer->title = $title;
     $offer->content = $content;
     $offer->cat_id = $category;
    
    
     $offer->image_url_original = 'http://test.arcazur.com/uploads/offers/'.$image_name[0];   
     $offer->status = 0;
          $offer->price = $price;

     $offer->save();
   for($i=0;$i<count($image_name);$i++){
      $gallery = new Imoffer();
      $gallery->offer_id= $offer->id;
      $gallery->img_name = 'http://test.arcazur.com/uploads/offers/'.$image_name[$i];
      $gallery->save();
    }

    return Redirect::back()->with('success', 'New Offer successfuly created');


  }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_offers()
    {
        $offers = Offer::OrderBy('id','DESC')->get();
        return view('admin.manage_offers',compact('offers'));
    }

    
    public function publish_offer($id)
    {

     $offer = Offer::findOrFail($id);
     if($offer->status == '0')
     {
       $offer->status = '1';
       $offer->save();
       return Redirect::Back()->with('success', 'This offer is Published');
     }
     else{
      $offer->status = '0';
      $offer->save();
      return Redirect::Back()->with('success', 'This offer is Unpublished');
    }
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view_offer($id)
    {
         Session::put('offer_id' , $id);
      $offers = Offer::findOrFail($id);
    
      $galleries = Imoffer::where('offer_id',$id)->get();



      return view('admin.offer_view',compact('offers','galleries'));
    }
    public function main_article($name)
    {
      $id = Session::get('offer_id');
      $articles = Offer::findOrFail($id);
      $articles->image_url_original = $name;
      $articles->save();
      return Redirect::back()->with('success' , 'Image set as main successfuly!!');


    }
      public function delete_image($id)
    {

      $gallery = Imoffer::findOrFail($id);
       // die(asset('uploads/articles/'.$gallery->img_name));
      unlink('uploads/offers/'.$gallery->img_name);

      $gallery->delete();
      return Redirect::back()->with('success' , 'Image was Deleted successfuly!!');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view_offer_save(Request $r, $id)
    {
        
      $title = $r->input('title');
      $content = $r->input('content');
      $category = $r->input('cat_id');
            $price = $r->input('price');

     $files = $r->file('attachments');

      $data = ['title' => $title,'content'=> $content, 'cat_id' => $category,'price' =>$price];

      $rules = ['title' => 'required' ,'content' => 'required','cat_id' => 'required','price'=>'required'];

      $v = Validator::make($data, $rules);

      if($v->fails()){
        return Redirect::Back()->withErrors($v);
      }else
      {
        if ($files[0] != '') {
          $image_name = array();
          foreach($files as $file) {
           $ran = mt_rand(111111,999999);
           $destinationPath = 'uploads/offers';
           $filename = $file->getClientOriginalExtension();
           $filename_r =$ran.'.'.$filename;
           $image_name[] = $filename_r;
           $file->move($destinationPath, $filename_r);
         }
}
         $article = Offer::findOrFail($id);
         $article->title = $title;
         $article->content = $content;
         $article->cat_id = $category;
                  $article->price = $price;

        
         
       //$article->image_url_original = $image_name[0];   
       //$article->status = 0;
         $article->save();
          if ($files[0] != '') {
         for($i=0;$i<count($image_name);$i++){
          $gallery = new Imoffer();
          $gallery->offer_id= $id;
          $gallery->img_name = $image_name[$i];
          $gallery->save();
        }
      }

        return Redirect::back()->with('success' , 'Offer was Updated successfuly!!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
