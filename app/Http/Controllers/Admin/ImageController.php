<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ImageController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display image library.
     */
    public function index(Request $request): View
    {
        $category = $request->get('category');
        $search = $request->get('search');
        $perPage = $request->get('per_page', 12);

        $query = Image::query();

        // Filter by category
        if ($category) {
            $query->category($category);
        }

        // Search by filename, alt_text, or title
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('filename', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $images = $query->latest()->paginate($perPage);
        $categories = Image::CATEGORIES;

        return view('admin.images.index', compact('images', 'categories', 'category', 'search'));
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        $categories = Image::CATEGORIES;
        $contexts = Image::CONTEXTS;
        return view('admin.images.create', compact('categories', 'contexts'));
    }

    /**
     * Store new image.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validation = $this->imageService->validateImage($request->file('image'));
            
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => implode(', ', $validation['errors'])
                ], 422);
            }

            $request->validate(
                $this->imageService->getValidationRules(),
                $this->imageService->getValidationMessages()
            );

            // Get admin ID if authenticated
            $uploadedBy = auth('admin')->id();

            $image = $this->imageService->upload(
                $request->file('image'),
                $request->input('category', 'general'),
                $request->input('context', 'other'),
                $request->input('alt_text'),
                $request->input('title'),
                $uploadedBy,
                $request->input('caption'),
                $request->boolean('is_visible', true),
                $request->boolean('is_primary', false),
                $request->input('sort_order', 0)
            );

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diupload!',
                'data' => $image->toImageArray()
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show image details.
     */
    public function show(Image $image): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $image->toImageArray()
        ]);
    }

    /**
     * Show edit form.
     */
    public function edit(Image $image): View
    {
        $categories = Image::CATEGORIES;
        $contexts = Image::CONTEXTS;
        return view('admin.images.edit', compact('image', 'categories', 'contexts'));
    }

    /**
     * Update image metadata.
     */
    public function update(Request $request, Image $image): JsonResponse
    {
        try {
            $request->validate([
                'alt_text' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'caption' => 'nullable|string|max:500',
                'category' => 'nullable|string|max:50',
                'context' => 'nullable|string|max:50',
                'is_visible' => 'nullable|boolean',
                'is_primary' => 'nullable|boolean',
                'sort_order' => 'nullable|integer|min:0'
            ], $this->imageService->getValidationMessages());

            $this->imageService->updateMetadata(
                $image,
                $request->input('alt_text'),
                $request->input('title'),
                $request->input('caption'),
                $request->input('category'),
                $request->input('context'),
                $request->boolean('is_visible'),
                $request->boolean('is_primary'),
                $request->input('sort_order')
            );

            return response()->json([
                'success' => true,
                'message' => 'Metadata gambar berhasil diperbarui!',
                'data' => $image->fresh()->toImageArray()
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Replace image file.
     */
    public function replace(Request $request, Image $image): JsonResponse
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:' . $this->imageService->getAllowedExtensionsString()
                    . '|max:' . $this->imageService->getMaxFileSizeKB()
            ], [
                'image.required' => 'Gambar wajib diupload.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar tidak didukung.',
                'image.max' => 'Ukuran gambar terlalu besar.'
            ]);

            $uploadedBy = auth('admin')->id();

            $newImage = $this->imageService->replaceImage(
                $image,
                $request->file('image'),
                $uploadedBy
            );

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diganti!',
                'data' => $newImage->toImageArray()
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete image.
     */
    public function destroy(Image $image): JsonResponse
    {
        try {
            $this->imageService->delete($image);

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle image visibility.
     */
    public function toggleVisibility(Image $image): JsonResponse
    {
        try {
            $image = $this->imageService->toggleVisibility($image);

            return response()->json([
                'success' => true,
                'message' => $image->is_visible ? 'Gambar ditampilkan!' : 'Gambar disembunyikan!',
                'is_visible' => $image->is_visible
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Set image as primary.
     */
    public function setPrimary(Image $image): JsonResponse
    {
        try {
            $image->setAsPrimary();

            return response()->json([
                'success' => true,
                'message' => 'Gambar ditetapkan sebagai gambar utama!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get images for selector (AJAX).
     */
    public function selector(Request $request): JsonResponse
    {
        $category = $request->get('category');
        $search = $request->get('search');

        $query = Image::query()->visible();

        if ($category) {
            $query->category($category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('filename', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $images = $query->latest()->limit(20)->get();

        return response()->json([
            'success' => true,
            'data' => $images->map(fn($img) => [
                'id' => $img->id,
                'url' => $img->url,
                'thumbnail' => $img->url,
                'filename' => $img->filename,
                'alt_text' => $img->alt_text,
                'dimensions' => $img->dimensions
            ])
        ]);
    }

    /**
     * Upload image via API (for inline upload in forms).
     */
    public function uploadApi(Request $request): JsonResponse
    {
        try {
            $validation = $this->imageService->validateImage($request->file('image'));
            
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => implode(', ', $validation['errors'])
                ], 422);
            }

            $uploadedBy = auth('admin')->id();
            $category = $request->get('category', 'general');

            $image = $this->imageService->upload(
                $request->file('image'),
                $category,
                'other',
                $request->input('alt_text'),
                $request->input('title'),
                $uploadedBy
            );

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diupload!',
                'data' => [
                    'id' => $image->id,
                    'url' => $image->url,
                    'thumbnail' => $image->url,
                    'filename' => $image->filename,
                    'alt_text' => $image->alt_text,
                    'dimensions' => $image->dimensions
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete images.
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $ids = $request->input('ids', []);
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada gambar yang dipilih.'
                ], 422);
            }

            $count = 0;
            foreach ($ids as $id) {
                $image = Image::find($id);
                if ($image) {
                    $this->imageService->delete($image);
                    $count++;
                }
            }

            return response()->json([
                'success' => true,
                'message' => "{$count} gambar berhasil dihapus!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk toggle visibility.
     */
    public function bulkToggleVisibility(Request $request): JsonResponse
    {
        try {
            $ids = $request->input('ids', []);
            $isVisible = $request->boolean('is_visible', true);
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada gambar yang dipilih.'
                ], 422);
            }

            $count = Image::whereIn('id', $ids)->update(['is_visible' => $isVisible]);

            return response()->json([
                'success' => true,
                'message' => "{$count} gambar berhasil " . ($isVisible ? 'ditampilkan' : 'disembunyikan') . "!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Register existing image from path.
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'path' => 'required|string',
                'category' => 'nullable|string|max:50',
                'context' => 'nullable|string|max:50',
                'alt_text' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255'
            ], [
                'path.required' => 'Path gambar wajib diisi.'
            ]);

            $uploadedBy = auth('admin')->id();

            $image = $this->imageService->registerExistingImage(
                $request->input('path'),
                $request->input('category', 'general'),
                $request->input('context', 'other'),
                $request->input('alt_text'),
                $request->input('title'),
                $uploadedBy
            );

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak ditemukan di storage.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil didaftarkan!',
                'data' => $image->toImageArray()
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics.
     */
    public function statistics(): JsonResponse
    {
        $total = Image::count();
        $visible = Image::where('is_visible', true)->count();
        $hidden = Image::where('is_visible', false)->count();
        
        $byCategory = Image::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        $totalSize = Image::sum('file_size');
        $avgSize = Image::avg('file_size') ?? 0;

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $total,
                'visible' => $visible,
                'hidden' => $hidden,
                'by_category' => $byCategory,
                'total_size' => $totalSize,
                'total_size_formatted' => round($totalSize / 1048576, 2) . ' MB',
                'average_size' => round($avgSize / 1024, 2) . ' KB'
            ]
        ]);
    }
}
