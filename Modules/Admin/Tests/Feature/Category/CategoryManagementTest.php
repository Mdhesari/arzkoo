<?php

namespace Modules\Admin\Tests\Feature\Category;

use App\Models\Category\Category;
use Tests\TestCase;
use Modules\Admin\Entities\Admin;

class CategoryManagementTest extends TestCase
{
    //TODO:apply repository pattern.

    protected $user;

    protected $count;

    protected $category;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();

        $this->artisan('db:seed');

        $this->user = Admin::factory()->create();

        $this->count = Category::all()->count();

        $this->category = Category::latest('id')->first();

        $this->actingAs($this->user);
    }
    /**
     * Test create category view
     *
     * @return void
     * @test
     */
    public function can_see_create_category_view()
    {
        $this->user->givePermissionTo('create webinar');

        $response = $this->get(route('admin.category.add'));

        $response->assertSuccessful();
    }
    /**
     * Test create category without parent
     *
     * @return void
     * @test
     */
    public function can_create_a_new_category_wit_parent()
    {
        $this->user->givePermissionTo('create webinar');

        $data = [
            'title' => 'هوش مصنوعی',

            'parent_id' => null
        ];

        $response = $this->post(route('admin.category.add', $data));

        $response->assertRedirect(route('admin.category.list'));

        $this->assertEquals(Category::all()->count(), $this->count + 1);

        $this->category = Category::latest('id')->first();

        $this->assertEquals($this->category->parent, null);
    }
    /**
     * Test create category with parent
     *
     * @return void
     * @test
     */
    public function can_create_a_new_category_without_parent()
    {
        $parent_category = Category::first();
        $this->user->givePermissionTo('create webinar');

        $data = [
            'title' => 'هوش طبیعی',

            'parent_id' => $parent_category->id
        ];

        $response = $this->post(route('admin.category.add', $data));

        $response->assertRedirect(route('admin.category.list'));

        $this->assertEquals(Category::all()->count(), $this->count + 1);

        $this->category = Category::latest('id')->first();

        $this->assertEquals($this->category->parent->toArray(), $parent_category->toArray());
    }
    /**
     * Test update category
     *
     * @return void
     * @test
     */
    public function can_update_category()
    {
        $this->user->givePermissionTo('create webinar');

        $data = [
            'title' => 'هوش نیمه طبیعی',

            'parent_id' => Category::skip(1)->first()->id
        ];

        $response = $this->post(route('admin.category.edit', $this->category), $data);

        $response->assertRedirect(route('admin.category.list'));

        //check if category data changed.
        $this->assertNotEquals(Category::latest()->first(), $this->category);

        //check if category parent chenged.
        $this->assertNotEquals(optional(Category::latest()->first()->parent)->id, optional($this->category->parent)->id);
    }
    /**
     * Test delete category with childs
     *
     * @return void
     * @test
     */
    public function can_delete_category_with_childs()
    {
        $this->user->givePermissionTo('create webinar');

        //TODO: must check parent.
        $this->withExceptionHandling();

        $data = [
            'delete_childs' => 1
        ];

        $category = Category::first();

        $descendants = $category->descendants;

        $response = $this->delete(route('admin.category.destroy', $category), $data);

        $response->assertRedirect(route('admin.category.list'));

        $this->assertEquals(Category::all()->count(), $this->count - $descendants->count() - 1);
    }
    /**
     * Test delete category without childs
     *
     * @return void
     * @test
     */
    public function can_delete_category_without_childs()
    {
        $this->user->givePermissionTo('create webinar');

        $category = Category::skip(3)->first();

        $parent = $category->parent;

        $children = $category->children;

        $response = $this->delete(route('admin.category.destroy', $category));

        $response->assertRedirect(route('admin.category.list'));

        $children = $this->refresh_child_category($children);

        $this->check_children_parent($children, $parent);

        $this->assertEquals(Category::all()->count(), $this->count - 1);
    }

    public function refresh_child_category($children)
    {
        $fresh_childs = [];

        //TODO: find better way to refresh categories;

        foreach ($children as $child) {

            $child = Category::find($child->id);

            array_push($fresh_childs, $child);
        }

        return $fresh_childs;
    }

    public function check_children_parent($children, $parent)
    {
        //TODO: this function should be refactored.
        if ($children == []) {

            $this->assertTrue(true);
        } else {

            foreach ($children as $child) {

                if ($parent == null && $child->parent == null) {

                    $this->assertTrue(true);
                } else {
                    $this->assertEquals($parent->title, $child->parent->title);
                }
            }
        }
    }
}
