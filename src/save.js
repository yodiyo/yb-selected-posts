/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @param {Object} root0            - The props object.
 * @param {Object} root0.attributes - The block attributes.
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element|null} Element to render.
 */
export default function save( { attributes } ) {
	const { selectedPost } = attributes;

	if ( ! selectedPost ) {
		return null;
	}

	// Extract necessary data from selectedPost
	const { title, link } = selectedPost;

	// Return the post link markup
	return (
		<p className="dmg-read-more" { ...useBlockProps.save() }>
			<span>{ __( 'Read more: ' ) }</span>
			<a href={ link }>{ title.rendered }</a>
		</p>
	);
}
