<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $product = Product::with('myCategory')->get();
            $product=Product::all();
            return response()->json(['status' => 'succsess', 'data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e], 404);
        }
    }

    // Store a newly created product using API request
    public function store(Request $request)
    {
        try {
            // $imageHash = md5_file($request->file('pr_image')->getPathname());
            // $request->merge([
            //     'image_hash' => $imageHash
            // ]);
            $request->validate([
                'pr_name' => 'required|string|unique:products|max:50',
                'pr_name_en' => 'required|string|max:50',
                'pr_image' => 'required|image',
                'pr_cost' => 'required|integer',
                'pr_detail' => 'required|string|max:150',
                'pr_detail_en' => 'required|string|max:150',
                'pr_discoutn' => 'integer',
                'cat_fk' => 'required|exists:categories,cat_id',
                // 'image_hash'=>'required|string|unique:products',
            ]);

            if (!$request->hasFile('pr_image')) {
                return response()->json(['status' => 'error', 'message' => 'No image file uploaded'], 400);
            }

            $imageHash = md5_file($request->file('pr_image')->getPathname());
            // التحقق من وجود نفس الصورة باستخدام التجزئة
            $existingRecord = Product::where('image_hash', $imageHash)->orWhere('pr_name', $request->input('pr_name'))->first();
            if ($existingRecord) {
                return response()->json(['status' => 'error', 'message' => 'the product is already exist'], 400);
            }

            $imageName = time() . '.' . $request->file('pr_image')->extension();
            $request->file('pr_image')->move(public_path('products'), $imageName);
            $imagePath = 'products/' . $imageName;

            $input = $request->all();
            $input['pr_image'] = $imagePath;
            $input['image_hash'] = $imageHash;
            
            if ($request->has('pr_discoutn')) {
                $input['pr_cost_new'] = $input['pr_cost'] - ($input['pr_cost'] * ($input['pr_discoutn'] / 100));
            }
            $product = Product::create($input);
            return response()->json(['status' => 'success', 'message' => 'Product created successfully!', 'data' => $product], 201);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // \Log::error('Product creation error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while creating the product: ' . $e->getMessage()], 500);
        }
    }

    // Display the specified product
    public function show($pr_id)
    {
        try{
        $product = Product::findOrFail($pr_id);
        return response()->json(['success' => true, 'data'=>$product]);
        }
        catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    // Update the specified product using API request
    public function update(Request $request, $pr_id)
    {
        try{
            // $product = Product::findOrFail($pr_id);
            $product=$request->all();
            return response()->json(['success' => true, 'data'=>$product]);
            }
            catch(\Exception $e){
                return response()->json(['success' => false, 'message' => $e]);
            }
    }

    // Remove the specified product using API request
    public function destroy($id)
    {
        try{
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully!']);
        }
        catch(\Exception $e){
        return response()->json(['success' => false, 'message' => $e]);
        }
    }
}
