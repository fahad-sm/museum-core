<?php

namespace MuseumCore\Register;

use MuseumCore\Util\Inflector;

class PostType extends Registerable
{
	private $title = null;
    private $singular = null;
    private $form = [];
    private $taxonomies = [];
    private $columns = [];
    private $metaBoxes = [];
    private $archiveQuery = [];
    private $icon = null;
    private $resource = null;

    /**
     * Make Post Type. Do not use before init hook.
     *
     * @param string $singular singular name is required
     * @param string $plural plural name
     * @param array $settings args override and extend
     */
    public function __construct( $singular, $plural = null, $settings = [] )
    {

        $this->singular = $singular;

        if(! $plural) {
            $plural = Inflector::pluralize($singular);
        }

        // make lowercase
        $singular      = strtolower( $singular );
        $plural        = strtolower( $plural );
        $upperSingular = ucwords( $singular );
        $upperPlural   = ucwords( $plural );

        $labels = [
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New ' . $upperSingular,
            'edit_item'          => 'Edit ' . $upperSingular,
            'menu_name'          => $upperPlural,
            'name'               => $upperPlural,
            'new_item'           => 'New ' . $upperSingular,
            'not_found'          => 'No ' . $plural . ' found',
            'not_found_in_trash' => 'No ' . $plural . ' found in Trash',
            'parent_item_colon'  => '',
            'search_items'       => 'Search ' . $upperPlural,
            'singular_name'      => $upperSingular,
            'view_item'          => 'View ' . $upperSingular,
        ];

        // setup object for later use
        $plural   = str_replace(' ', '_', $plural );
        $singular = str_replace(' ', '_', $singular );
        $this->resource = [$singular, $plural];
        $this->id       = ! $this->id ? $singular : $this->id;

        if (array_key_exists( 'capabilities', $settings ) && $settings['capabilities'] === true) :
            $settings['capabilities'] = [
                'publish_posts'       => 'publish_' . $plural,
                'edit_post'           => 'edit_' . $singular,
                'edit_posts'          => 'edit_' . $plural,
                'edit_others_posts'   => 'edit_others_' . $plural,
                'delete_post'         => 'delete_' . $singular,
                'delete_posts'        => 'delete_' . $plural,
                'delete_others_posts' => 'delete_others_' . $plural,
                'read_post'           => 'read_' . $singular,
                'read_private_posts'  => 'read_private_' . $plural,
            ];
        endif;

        $defaults = [
            'labels'      => $labels,
            'description' => $plural,
            'rewrite'     => [ 'slug' => sanitize_title( $this->id ) ],
            'public'      => true,
            'supports'    => [ 'title', 'editor' ],
            'has_archive' => true,
            'taxonomies'  => [ ]
        ];

        if (array_key_exists( 'taxonomies', $settings )) {
            $this->taxonomies       = array_merge( $this->taxonomies, $settings['taxonomies'] );
            $settings['taxonomies'] = $this->taxonomies;
        }

        $this->args = array_merge( $defaults, $settings );

        return $this;
    }

    /**
     * Set the post type menu icon
     *
     * Add the CSS needed to create the icon for the menu
     *
     * @param $name
     *
     * @return $this
     */
    public function setIcon( $name )
    {
        $this->icon = $name;
        $this->args['menu_icon'] = $name;
        return $this;
    }

    /**
     * Get the post type icon
     *
     * @return null
     */
    public function getIcon() {
        return $this->icon;
    }

    /**
     * Register post type with WordPress
     *
     * Use the registered_post_type hook if you need to update
     * the post type.
     *
     * @return $this
     */
    public function register()
    {
        $supports = array_unique(array_merge($this->args['supports'], $this->metaBoxes));
        $this->args['supports'] = $supports;

        register_post_type( $this->id, $this->args );
        
        return $this;
    }

    /**
     * Add Column To Admin Table
     *
     * @param string|null $field the name of the field
     * @param bool $sort make column sortable
     * @param string|null $label the label for the table header
     * @param callback|null $callback the function used to display the field data
     * @param string $order_by is the column a string or number
     *
     * @return $this
     */
    public function addColumn($field, $sort = false, $label = null, $callback = null, $order_by = '') {
        if( ! $label ) { $label = $field; }
        $field = Sanitize::underscore( $field );
        if( ! $callback ) {
            $callback = function($value) {
                echo $value;
            };
        }

        $this->columns[$field] = [
            'field' => $field,
            'sort' => $sort,
            'label' => $label,
            'callback' => $callback,
            'order_by' => $order_by
        ];

        return $this;
    }

    /**
     * Set the rewrite slug for the post type
     *
     * @param $slug
     *
     * @return $this
     */
    public function setSlug( $slug )
    {
        $this->args['rewrite'] = ['slug' => sanitize_title( $slug )];

        return $this;
    }

    /**
     * Get the rewrite slug
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->args['rewrite']['slug'];
    }

    /**
     * @param bool|string $rest_base the REST API base path
     *
     * @return $this
     */
    public function setRest( $rest_base = false )
    {
        $this->args['rest_base'] = $rest_base ? $rest_base : $this->id;
        $this->args['show_in_rest'] = true;

        return $this;
    }

    /**
     * Add to WordPress permalinks so user can change it.
     */
    public function addToPermalinks() {
        add_action( 'load-options-permalink.php', [$this, 'load_permalinks'] );

        $key = 'museum_core_'.$this->id.'_base';

        if ( get_option( $key ) ) {
            $this->setSlug( get_option( $key ) );
        }

        return $this;
    }

    /**
     * Permalinks callback.
     * 
     * @return [type] [description]
     */
    public function load_permalinks() {
        $key = 'museum_core_'.$this->id.'_base';
        if( isset( $_POST[ $key ] ) ) {
            update_option( $key, sanitize_title_with_dashes( $_POST[ $key ] ) );
        }
        
        // Add a settings field to the permalink page
        add_settings_field( $key, sprintf(__( '%s Base' ), $this->singular), [$this, 'permalink_callback'], 'permalink', 'optional' );
        
    }

    /**
     * Permalinks callback.
     * 
     * @return [type] [description]
     */
    public function permalink_callback()
    {
        $key = 'museum_core_'.$this->id.'_base';

        $value = get_option( $key );   
        $value = ($value) ? $value : $this->id; 
        $is_multi = is_multisite() ? '/blog' : '';

        echo $is_multi.'<input type="text" value="' . esc_attr( $value ) . '" name="'.$key.'" id="'.$key.'" class="regular-text" />';
    }
}