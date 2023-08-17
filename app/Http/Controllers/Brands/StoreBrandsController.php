<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class StoreBrandsController extends Controller
{
    public function __invoke(Request $request)
    {
        $brand = new Brand();
        $brand->domain = $request->input('domain');
        $brand->primary_color = $request->input('primary_color');
        $brand->save();

        if ($request->hasFile('square_logo')) {
            $file = $request->file('square_logo');
            $path = 'square_logo';
            $fileName = strval($brand->id);
            uploadFile($file, $fileName, $path);
            $brand->square_logo_url = '/storage/' . $path . '/' . $fileName . '.png';
            $brand->save();
        }

        if ($request->hasFile('rectangular_logo')) {
            $file = $request->file('rectangular_logo');
            $path = 'rectangular_logo';
            $fileName = strval($brand->id);
            uploadFile($file, $fileName, $path);
            $brand->rectangular_logo_url = '/storage/' . $path . '/' . $fileName . '.png';
            $brand->save();
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $path = 'distributor_banner';
            $fileName = strval($brand->id);
            uploadFile($file, $fileName, $path);
            $brand->banner = '/storage/' . $path . '/' . $fileName . '.png';
            $brand->save();
        }

        return redirect()->route('brands.index');
    }
}
